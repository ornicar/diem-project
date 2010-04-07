<?php

/**
 * doc admin form
 *
 * @package    diemSite
 * @subpackage doc
 * @author     Your name here
 */
class DocAdminForm extends BaseDocForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}