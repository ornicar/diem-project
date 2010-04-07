<?php

/**
 * snippetComment admin form
 *
 * @package    diem-project
 * @subpackage snippetComment
 * @author     Thibault D
 */
class SnippetCommentAdminForm extends BaseSnippetCommentForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}