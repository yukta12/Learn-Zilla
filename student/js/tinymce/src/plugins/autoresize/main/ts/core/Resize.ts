/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { Element } from '@ephox/dom-globals';
import { Cell } from '@ephox/katamari';
import { Editor } from 'tinymce/core/api/Editor';
import Env from 'tinymce/core/api/Env';
import DOMUtils from 'tinymce/core/api/dom/DOMUtils';
import Delay from 'tinymce/core/api/util/Delay';
import Settings from '../api/Settings';

/**
 * This class contains all core logic for the autoresize plugin.
 *
 * @class tinymce.autoresize.Plugin
 * @private
 */

const isFullscreen = (editor: Editor) => {
  return editor.plugins.fullscreen && editor.plugins.fullscreen.isFullscreen();
};

/**
 * Calls the resize x times in 100ms intervals. We can't wait for load events since
 * the CSS files might load async.
 */
const wait = (editor: Editor, oldSize: Cell<number>, times: number, interval: number, callback?: Function) => {
  Delay.setEditorTimeout(editor, () => {
    resize(editor, oldSize);

    if (times--) {
      wait(editor, oldSize, times, interval, callback);
    } else if (callback) {
      callback();
    }
  }, interval);
};

const toggleScrolling = (editor: Editor, state: boolean) => {
  const body = editor.getBody();
  if (body) {
    body.style.overflowY = state ? '' : 'hidden';
    if (!state) {
      body.scrollTop = 0;
    }
  }
};

const getMargin = (dom: DOMUtils, elm: Element, pos: string, computed: boolean): number => {
  const value = parseInt(dom.getStyle(elm, `margin-${pos}`, computed), 10);
  // Margin maybe be an empty string, so in that case treat it as being 0
  return isNaN(value) ? 0 : value;
};

/**
 * This method gets executed each time the editor needs to resize.
 */
const resize = (editor: Editor, oldSize: Cell<number>) => {
  let deltaSize, resizeHeight, contentHeight;
  const dom = editor.dom;

  const doc = editor.getDoc();
  if (!doc) {
    return;
  }

  if (isFullscreen(editor)) {
    toggleScrolling(editor, true);
    return;
  }

  const body = doc.body;
  resizeHeight = Settings.getAutoResizeMinHeight(editor);

  // Calculate outer height of the body element using CSS styles
  const marginTop = getMargin(dom, body, 'top', true);
  const marginBottom = getMargin(dom, body, 'bottom', true);
  contentHeight = body.offsetHeight + marginTop + marginBottom;

  // Make sure we have a valid height
  // Note: Previously we had to do some fallbacks here for IE/Webkit, as the height calculation above didn't work.
  //       However using the latest supported browsers (IE 11 & Safari 11), the fallbacks were no longer needed and were removed.
  if (contentHeight < 0) {
    contentHeight = 0;
  }

  // Determine the size of the chroming (menubar, toolbar, etc...)
  const containerHeight = editor.getContainer().scrollHeight;
  const contentAreaHeight = editor.getContentAreaContainer().scrollHeight;
  const chromeHeight = containerHeight - contentAreaHeight;

  // Don't make it smaller than the minimum height
  if (contentHeight + chromeHeight > Settings.getAutoResizeMinHeight(editor)) {
    resizeHeight = contentHeight + chromeHeight;
  }

  // If a maximum height has been defined don't exceed this height
  const maxHeight = Settings.getAutoResizeMaxHeight(editor);
  if (maxHeight && resizeHeight > maxHeight) {
    resizeHeight = maxHeight;
    toggleScrolling(editor, true);
  } else {
    toggleScrolling(editor, false);
  }

  // Resize content element
  if (resizeHeight !== oldSize.get()) {
    deltaSize = resizeHeight - oldSize.get();
    dom.setStyle(editor.getContainer(), 'height', resizeHeight + 'px');
    oldSize.set(resizeHeight);

    // WebKit doesn't decrease the size of the body element until the iframe gets resized
    // So we need to continue to resize the iframe down until the size gets fixed
    if (Env.webkit && deltaSize < 0) {
      resize(editor, oldSize);
    }
  }
};

const setup = (editor: Editor, oldSize: Cell<number>) => {
  editor.on('init', () => {
    const overflowPadding = Settings.getAutoResizeOverflowPadding(editor);
    const bottomMargin = Settings.getAutoResizeBottomMargin(editor);
    const dom = editor.dom;

    dom.setStyles(editor.getBody(), {
      'paddingLeft': overflowPadding,
      'paddingRight': overflowPadding,
      'paddingBottom': bottomMargin,
      // IE & Edge have a min height of 150px by default on the body, so override that
      'min-height': 0
    });
  });

  editor.on('nodechange setcontent keyup FullscreenStateChanged', function (e) {
    resize(editor, oldSize);
  });

  if (Settings.shouldAutoResizeOnInit(editor)) {
    editor.on('init', () => {
      // Hit it 20 times in 100 ms intervals
      wait(editor, oldSize, 20, 100, () => {
        // Hit it 5 times in 1 sec intervals
        wait(editor, oldSize, 5, 1000);
      });
    });
  }
};

export default {
  setup,
  resize
};