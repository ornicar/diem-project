<?php

echo _open('div.box');

if($user)
{
  echo _link('@signout')->text(__('Signout'))->set('.user_signout.fright');
  
  echo _tag('strong.box_title', $user->username);

  if($plugins->count())
  {
    echo _open('div.box_inner');
    
    echo _tag('strong', __('My plugins'));
    
    echo _open('ul.box_list.mt5');

    foreach($plugins as $plugin)
    {
      echo _tag('li', _link($plugin));
    }

    echo _close('ul');
    echo _close('div');
  }
  else
  {
    echo _tag('div.user_inner', __('You have no plugin.'));
  }

  echo _tag('div.text_align_center.mt10', _link('plugin/create')->set('.button.blue'));
}
else
{
  echo _tag('strong.mb10.block.box_title', __('Manage your plugins'));
  
  echo $form->open('.box_inner.clearfix action=@signin');

  echo _tag('ul',

    _tag('li.dm_form_element', $form['username']->label()->field()->error()).

    _tag('li.dm_form_element', $form['password']->label()->field()->error())

  );

  echo $form->renderHiddenFields();

  echo $form->submit(__('Signin'));

  echo _link('main/register')
  ->text(__('Create an account'))
  ->title(__('Allows you to add plugins to this list'));

  echo '<br />';

  echo _link('main/forgotPassword')
  ->text(__('Forgot your password?'))
  ->title(__('Receive a new password'));

  echo $form->close();
}

echo _close('div');