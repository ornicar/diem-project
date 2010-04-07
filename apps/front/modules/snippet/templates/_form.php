<?php

echo $form->open('.snippet_form'),

£('ul',

  £('li.clearfix',
    $form['name']->label(__('Title'))->field()->error()
  ).

  £('li.clearfix',
    $form['text']->label( __('Content'))->field()->error()
  ).

  £('li.clearfix',
    $form['created_by']->label(__('Author'))->field()->error()
  ).

  (isset($form['captcha']) ? £('li.clearfix',
    $form['captcha']->label('Captcha', 'for=false')->field()->error()
  ) : '').

  £('li.clearfix',
    $form->submit(__('Publish the snippet'))
  )

).

$form->renderHiddenFields().
$form->close();