<?php

/**
 * CommunityArticle form.
 *
 * @package    diem-project
 * @subpackage form
 * @author     Thibault D
 * @version    SVN: $Id$
 */
class CommunityArticleForm extends BaseCommunityArticleForm
{
  public function configure()
  {
    unset($this['is_active']);
  }
}