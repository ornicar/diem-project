<?php

/**
 * SnippetComment form.
 *
 * @package    diem-project
 * @subpackage form
 * @author     Thibault D
 * @version    SVN: $Id$
 */
class SnippetCommentForm extends BaseSnippetCommentForm
{
  public function configure()
  {
    $this->validatorSchema['text']
    ->setOption('required', true)
    ->setMessage('required', 'Please enter a message');
    
    $this->widgetSchema['captcha'] = new myWidgetFormReCaptcha(array(
      'public_key' => sfConfig::get('app_recaptcha_public_key')
    ));
    
    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => sfConfig::get('app_recaptcha_private_key')
    ));
    
    $this->useFields(array('name', 'text', 'snippet_id', 'captcha'));
  }
}