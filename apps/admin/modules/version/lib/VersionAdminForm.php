<?php

/**
 * version admin form
 *
 * @package    diemSite
 * @subpackage version
 * @author     Your name here
 */
class VersionAdminForm extends BaseVersionForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}