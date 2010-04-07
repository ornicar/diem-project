<?php
// Snippet : Form edit
// Vars : $form


if ($sf_user->getFlash('form_saved'))
{
  echo £('p.mt20.mb20', 'Your snippet has been saved');
}
  
echo $form->open('.snippet_form action="snippet/modifyYourSnippet?hash='.$form->getObject()->hash.'"'),

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
    $form->submit(__('Modify the snippet'))
  )

).

$form->renderHiddenFields().

$form->close();