<?php

/**
 * @see sfWidgetFormReCaptcha
 */
class myWidgetFormReCaptcha extends sfWidgetFormReCaptcha
{
  /**
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    // html5 compliance
    return str_replace('frameborder="0"', 'seamless', parent::render($name, $value, $attributes, $errors));
  }
}