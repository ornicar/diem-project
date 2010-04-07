<?php
/**
 * Documentation page components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 */
class docPageComponents extends dmFrontModuleComponents
{

  public function executeListByDoc()
  {
    $query = $this->getListQuery();
    $this->docPagePager = $this->getPager($query);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery();
    
    $this->docPage = $this->getRecord($query);
    
    $this->previous = $this->docPage->getPrevious();
    
    $this->next = $this->docPage->getNext();
    
    $this->preloadPages(array($this->previous, $this->next));
  }


}
