<?php

/**
 * plugin admin form
 *
 * @package    diem-project
 * @subpackage plugin
 * @author     Thibault D
 */
class PluginAdminForm extends BasePluginForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}