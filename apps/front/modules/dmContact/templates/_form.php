<?php
// Contact : Form
// Vars : $form

if($sf_user->hasFlash('contact_form_valid'))
{
  echo £('p.form_valid', __('Thank you for your message.'));
}

// open the form tag with a dm_contact_form css class
echo $form->open();

echo £o('ul');

// write name label, field and error message
echo £('li.clearfix', $form['name']->label()->field()->error());

// same with email
echo £('li.clearfix', $form['email']->label()->field()->error());

echo £('li.clearfix.message', $form['body']->label('Your message')->field()->error());

// render captcha if enabled
if($form->isCaptchaEnabled())
{
  echo £('li.clearfix', $form['captcha']->label('Captcha', 'for=false')->field()->error());
}

echo $form->renderHiddenFields();

// change the submit button text
echo £('div.submit_wrap', $form->submit('Send'));

// close the form tag
echo $form->close();  