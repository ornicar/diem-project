<?php

/**
 * docPage admin form
 *
 * @package    diemSite
 * @subpackage docPage
 * @author     Your name here
 */
class DocPageAdminForm extends BaseDocPageForm
{
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['doc_id']->setOption('method', 'getFullName');
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}