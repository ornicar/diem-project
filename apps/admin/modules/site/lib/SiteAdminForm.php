<?php

/**
 * site admin form
 *
 * @package    diemSite
 * @subpackage site
 * @author     Your name here
 */
class SiteAdminForm extends BaseSiteForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}