<?php
/**
 * Snippet comment components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class snippetCommentComponents extends myFrontModuleComponents
{

  public function executeListBySnippet()
  {
    $query = $this->getListQuery();
    $this->snippetCommentPager = $this->getPager($query);
  }

  public function executeForm()
  {
    $this->form = $this->forms['SnippetComment'];
  }


}
