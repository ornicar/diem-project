<?php

/**
 * pluginComment admin form
 *
 * @package    diem-project
 * @subpackage pluginComment
 * @author     Thibault D
 */
class PluginCommentAdminForm extends BasePluginCommentForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}