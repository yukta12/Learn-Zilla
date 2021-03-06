import { ApproxStructure, Assertions, Pipeline, Log } from '@ephox/agar';
import { UnitTest } from '@ephox/bedrock';
import { TinyApis, TinyLoader, TinyUi } from '@ephox/mcagar';

import Plugin from 'tinymce/plugins/visualchars/Plugin';
import Theme from 'tinymce/themes/silver/Theme';

UnitTest.asynctest('browser.tinymce.plugins.visualchars.PluginTest', (success, failure) => {

  Plugin();
  Theme();

  const spanStruct = ApproxStructure.build(function (s, str) {
    return s.element('body', {
      children: [
        s.element('p', {
          children: [
            s.text(str.is('a')),
            s.element('span', {}),
            s.element('span', {}),
            s.text(str.is('b'))
          ]
        })
      ]
    });
  });

  const nbspStruct = ApproxStructure.build(function (s, str) {
    return s.element('body', {
      children: [
        s.element('p', {
          children: [
            s.text(str.is('a')),
            s.text(str.is('\u00a0')),
            s.text(str.is('\u00a0')),
            s.text(str.is('b'))
          ]
        })
      ]
    });
  });

  TinyLoader.setup(function (editor, onSuccess, onFailure) {
    const tinyUi = TinyUi(editor);
    const tinyApis = TinyApis(editor);

    Pipeline.async({}, Log.steps('TBA', 'VisualChars: Set content, click visual chars button and assert span char is present in whitespaces, click the button again and assert no span is present in the whitespace', [
      tinyApis.sSetContent('<p>a&nbsp;&nbsp;b</p>'),
      Assertions.sAssertEq('assert equal', 0, editor.dom.select('span').length),
      tinyUi.sClickOnToolbar('click on visualchars button', 'button'),
      tinyApis.sAssertContentStructure(spanStruct),
      tinyUi.sClickOnToolbar('click on visualchars button', 'button'),
      tinyApis.sAssertContentStructure(nbspStruct),
      tinyUi.sClickOnToolbar('click on visualchars button', 'button'),
      tinyApis.sAssertContentStructure(spanStruct),
      tinyUi.sClickOnToolbar('click on visualchars button', 'button'),
      tinyApis.sAssertContentStructure(nbspStruct)
    ]), onSuccess, onFailure);
  }, {
    plugins: 'visualchars',
    toolbar: 'visualchars',
    base_url: '/project/js/tinymce'
  }, success, failure);
});
