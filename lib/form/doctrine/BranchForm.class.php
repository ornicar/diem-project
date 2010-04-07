<?php

/**
 * Branch form.
 *
 * @package    diemSite
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BranchForm extends BaseBranchForm
{
  public function configure()
  {
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}