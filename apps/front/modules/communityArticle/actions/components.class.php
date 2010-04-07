<?php
/**
 * Community article components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class communityArticleComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    $this->communityArticlePager = $this->getPager($query);
  }

  public function executeForm()
  {
    $this->form = $this->forms['CommunityArticle'];
  }


}
