<?php

/**
 * Comment form.
 *
 * @package    diemSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
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
    
    $this->useFields(array('name', 'text', 'article_id', 'captcha'));
  }
}
