/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { createPatternSet, PatternSet, normalizePattern } from './Pattern';
import { Obj, Type, Results, Arr, Global } from '@ephox/katamari';
import { Console } from '@ephox/dom-globals';

const error = function (...args: Parameters<Console['error']>) {
  const console: Console = Global.console;
  if (console) { // Skip test env
    if (console.error) { // tslint:disable-line:no-console
      console.error.apply(console, args); // tslint:disable-line:no-console
    } else {
      console.log.apply(console, args); // tslint:disable-line:no-console
    }
  }
};

const defaultPatterns = [
  { start: '*', end: '*', format: 'italic' },
  { start: '**', end: '**', format: 'bold' },
  { start: '#', format: 'h1' },
  { start: '##', format: 'h2' },
  { start: '###', format: 'h3' },
  { start: '####', format: 'h4' },
  { start: '#####', format: 'h5' },
  { start: '######', format: 'h6' },
  { start: '1. ', cmd: 'InsertOrderedList' },
  { start: '* ', cmd: 'InsertUnorderedList' },
  { start: '- ', cmd: 'InsertUnorderedList' }
];

const getPatternSet = (editorSettings): PatternSet => {
  const patterns = Obj.get(editorSettings, 'textpattern_patterns').getOr(defaultPatterns);
  if (!Type.isArray(patterns)) {
    error('The setting textpattern_patterns should be an array');
    return {
      inlinePatterns: [],
      blockPatterns: [],
    };
  }
  const normalized = Results.partition(Arr.map(patterns, normalizePattern));
  Arr.each(normalized.errors, (err) => error(err.message, err.pattern));
  return createPatternSet(normalized.values);
};

export {
  getPatternSet,
};