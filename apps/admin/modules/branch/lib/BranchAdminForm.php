<?php

/**
 * branch admin form
 *
 * @package    diemSite
 * @subpackage branch
 * @author     Your name here
 */
class BranchAdminForm extends BaseBranchForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}