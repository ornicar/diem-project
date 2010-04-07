<?php
/**
 * Branch components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 */
class branchComponents extends dmFrontModuleComponents
{

  public function executeListMenu()
  {
    $query = $this->getListQuery('b')
    ->leftJoin('b.Versions v')
    ->orderBy('v.position ASC')
    ->having('v.is_active = ?', true);
    $this->branchPager = $this->getPager($query);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery('b');
    
    $this->branch = $this->getRecord($query);
    $this->tuto = dmDb::query('DocPage p')
    ->withI18n()
    ->leftJoin('p.Doc d')
    ->where('d.type = ?', 'tuto')
    ->orderBy('p.position ASC')
    ->fetchOne();
    $this->howTo = dmDb::query('Doc d')
    ->withI18n()
    ->where('d.type = ?', 'howto')
    ->fetchOne();
    $this->openSourceProjects = dmDb::query('DocPage p')
    ->withI18n()
    ->where('pTranslation.name = ?', 'Open source projects')
    ->fetchOne();
  }

  public function executeList()
  {
    $query = $this->getListQuery();
    $this->branchPager = $this->getPager($query);
  }

  public function executeListChoice()
  {
    $query = $this->getListQuery();
    
    $this->branches = $query->fetchRecords();

    if($this->getPage() && ($currentRecord = $this->getPage()->getRecord()))
    {
      $this->currentBranch = $currentRecord->getAncestorRecord('Branch');
    }
    else
    {
      $this->currentBranch = null;
    }

    if(!$this->currentBranch)
    {
      throw new dmException('This widget can not be used on this page!');
    }
  }


}
