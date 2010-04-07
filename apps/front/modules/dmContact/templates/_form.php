<?php
// Contact : Form
// Vars : $form

if($sf_user->hasFlash('contact_form_valid'))
{
  echo _tag('p.form_valid', __('Thank you for your message.'));
}

// open the form tag with a dm_contact_form css class
echo $form->open();

echo _open('ul');

// write name label, field and error message
echo _tag('li.clearfix', $form['name']->label()->field()->error());

// same with email
echo _tag('li.clearfix', $form['email']->label()->field()->error());

echo _tag('li.clearfix.message', $form['body']->label('Your message')->field()->error());

// render captcha if enabled
if($form->isCaptchaEnabled())
{
  echo _tag('li.clearfix', $form['captcha']->label('Captcha', 'for=false')->field()->error());
}

echo $form->renderHiddenFields();

// change the submit button text
echo _tag('div.submit_wrap', $form->submit('Send'));

// close the form tag
echo $form->close();  