<?php

if ($sf_user->getFlash('form_saved'))
{
  echo £('p', 'Thanks for your comment');
}

echo $form->open('anchor=1'),

£('ul',

  £('li.clearfix',
    $form['name']->label(__('Name'))->field()->error()
  ).

  £('li.clearfix',
    $form['text']->label(£('strong', __('Message')))->field()->error()
  ).

  £('li.clearfix',
    $form['captcha']->label('Captcha', 'for=false')->field()->error()
  ).

  £('li.clearfix',
    $form->submit(__('Send the comment'))
  )

).

$form->renderHiddenFields().

$form->close();