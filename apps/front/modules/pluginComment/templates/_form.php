<?php
/*
 * Action for Comment : Form
 * Vars : $form
 */

if ($sf_user->getFlash('form_saved'))
{
  echo £('p', 'Thanks for your comment');
}

echo $form->open('anchor=plugin-comments'),

£('ul',

  £('li.clearfix',
    $form['name']->label(__('Name'))->field()->error()
  ).

  £('li.clearfix',
    $form['text']->label(£('strong', __('Message')))->field()->error()
  ).

  ($form->isCaptchaEnabled()
  ? £('li.clearfix',
      $form['captcha']->label('Captcha', 'for=false')->field()->error()
    )
  : '').

  £('li.clearfix',
    $form->submit(__('Send the comment'))
  )

).

$form->renderHiddenFields().

$form->close();