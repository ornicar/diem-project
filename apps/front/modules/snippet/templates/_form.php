<?php

echo $form->open('.snippet_form'),

_tag('ul',

  _tag('li.clearfix',
    $form['name']->label(__('Title'))->field()->error()
  ).

  _tag('li.clearfix',
    $form['text']->label( __('Content'))->field()->error()
  ).

  _tag('li.clearfix',
    $form['created_by']->label(__('Author'))->field()->error()
  ).

  (isset($form['captcha']) ? _tag('li.clearfix',
    $form['captcha']->label('Captcha', 'for=false')->field()->error()
  ) : '').

  _tag('li.clearfix',
    $form->submit(__('Publish the snippet'))
  )

).

$form->renderHiddenFields().
$form->close();