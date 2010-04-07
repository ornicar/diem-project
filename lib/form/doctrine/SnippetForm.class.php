<?php

/**
 * Snippet form.
 *
 * @package    diem-project
 * @subpackage form
 * @author     Thibault D
 * @version    SVN: $Id$
 */
class SnippetForm extends BaseSnippetForm
{
  public function configure()
  {
    $this->validatorSchema['text']
    ->setOption('required', true);
    
    $this->widgetSchema['captcha'] = new myWidgetFormReCaptcha(array(
      'public_key' => sfConfig::get('app_recaptcha_public_key')
    ));
    
    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => sfConfig::get('app_recaptcha_private_key')
    ));
    
    unset($this['is_active'], $this['hash']);
    
    if (sfConfig::get('sf_debug'))
    {
      unset($this['captcha']);
    }
  }
}