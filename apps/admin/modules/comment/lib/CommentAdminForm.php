<?php

/**
 * comment admin form
 *
 * @package    diemSite
 * @subpackage comment
 * @author     Your name here
 */
class CommentAdminForm extends BaseCommentForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}