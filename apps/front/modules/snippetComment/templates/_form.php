<?php

if ($sf_user->getFlash('form_saved'))
{
  echo _tag('p', 'Thanks for your comment');
}

echo $form->open('anchor=1'),

_tag('ul',

  _tag('li.clearfix',
    $form['name']->label(__('Name'))->field()->error()
  ).

  _tag('li.clearfix',
    $form['text']->label(_tag('strong', __('Message')))->field()->error()
  ).

  _tag('li.clearfix',
    $form['captcha']->label('Captcha', 'for=false')->field()->error()
  ).

  _tag('li.clearfix',
    $form->submit(__('Send the comment'))
  )

).

$form->renderHiddenFields().

$form->close();