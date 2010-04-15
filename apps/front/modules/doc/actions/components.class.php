<?php
/**
 * Doc components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 * 
 * 
 */
class docComponents extends dmFrontModuleComponents
{

  public function executeShow()
  {
    $query = $this->getShowQuery('d');
    $this->doc = $this->getRecord($query);
  }

  public function executeListMenu()
  {
    $query = $this->getListQuery('d')
    ->leftJoin('d.Pages p')
    ->leftJoin('p.Translation pTranslation')
    ->andWhere('pTranslation.is_active = ?', true)
    ->addOrderBy('d.position ASC, p.position ASC');
    
    $this->docPager = $this->getPager($query);
    
    // manually preload the DocPage pages
    $docPages = array();
    foreach($this->docPager->getResults() as $doc)
    {
      $docPages = array_merge($docPages, $doc->Pages->getData());
    }
    $this->preloadPages($docPages);
    
    $this->summary = new markdownSummary($this->context->get('markdown'));
  }

}
