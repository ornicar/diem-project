<?php

/**
 * article admin form
 *
 * @package    diemSite
 * @subpackage article
 * @author     Your name here
 */
class ArticleAdminForm extends BaseArticleForm
{
  public function configure()
  {
    parent::configure();
    
    // Unset automatic fields like 'created_at', 'updated_at', 'created_by', 'updated_by'
    $this->unsetAutoFields();
  }
}