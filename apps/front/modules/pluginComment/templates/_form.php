<?php
/*
 * Action for Comment : Form
 * Vars : $form
 */

if ($sf_user->getFlash('form_saved'))
{
  echo _tag('p', 'Thanks for your comment');
}

echo $form->open('anchor=plugin-comments'),

_tag('ul',

  _tag('li.clearfix',
    $form['name']->label(__('Name'))->field()->error()
  ).

  _tag('li.clearfix',
    $form['text']->label(_tag('strong', __('Message')))->field()->error()
  ).

  ($form->isCaptchaEnabled()
  ? _tag('li.clearfix',
      $form['captcha']->label('Captcha', 'for=false')->field()->error()
    )
  : '').

  _tag('li.clearfix',
    $form->submit(__('Send the comment'))
  )

).

$form->renderHiddenFields().

$form->close();