<?php
/**
 * Article components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 * 
 * 
 */
class articleComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery('a')
    ->leftJoin('a.CreatedBy author');
    
    $this->articlePager = $this->getPager($query);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery('a')
    ->leftJoin('a.CreatedBy author')
    ->leftJoin('a.Comments c');
    
    $this->article = $this->getRecord($query);
  }

  public function executeListMenu()
  {
    $query = $this->getListQuery();
    
    $this->articlePager = $this->getPager($query);
  }

  public function executeTitle()
  {
    // Your code here
  }


}
