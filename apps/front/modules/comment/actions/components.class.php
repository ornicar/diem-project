<?php
/**
 * Comment components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 */
class commentComponents extends dmFrontModuleComponents
{

  public function executeListByArticle()
  {
    $query = $this->getListQuery();
    $this->commentPager = $this->getPager($query);
  }

  public function executeForm()
  {
    $this->form = $this->forms['Comment'];
  }


}
