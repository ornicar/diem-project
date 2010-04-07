<?php
// Snippet : Form edit
// Vars : $form


if ($sf_user->getFlash('form_saved'))
{
  echo _tag('p.mt20.mb20', 'Your snippet has been saved');
}
  
echo $form->open('.snippet_form action="snippet/modifyYourSnippet?hash='.$form->getObject()->hash.'"'),

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
    $form->submit(__('Modify the snippet'))
  )

).

$form->renderHiddenFields().

$form->close();