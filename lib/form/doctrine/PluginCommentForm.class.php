<?php

/**
 * PluginComment form.
 *
 * @package    diem-project
 * @subpackage form
 * @author     Thibault D
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PluginCommentForm extends BasePluginCommentForm
{
  public function configure()
  {
    $this->validatorSchema['text']
    ->setOption('required', true)
    ->setMessage('required', 'Please enter a message');

    if ($this->isCaptchaEnabled())
    {
      $this->addCaptcha();
      $this->useFields(array('name', 'text', 'plugin_id', 'captcha'));
    }
    else
    {
      $this->useFields(array('name', 'text', 'plugin_id'));
    }
  }

  public function addCaptcha()
  {
    $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
      'public_key' => sfConfig::get('app_recaptcha_public_key')
    ));

    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => sfConfig::get('app_recaptcha_private_key')
    ));
  }

  public function isCaptchaEnabled()
  {
    return sfConfig::get('app_recaptcha_enabled');
  }
}
