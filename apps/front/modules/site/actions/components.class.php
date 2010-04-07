<?php
/**
 * Site using Diem components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 */
class siteComponents extends dmFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery('s')
    ->withDmMedia('Media');
    $this->sitePager = $this->getPager($query);
  }


}
