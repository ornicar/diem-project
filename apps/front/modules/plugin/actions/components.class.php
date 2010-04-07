<?php
/**
 * Plugin components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 * 
 */
class pluginComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery('p')
    ->leftJoin('p.CreatedBy createdBy')
//    ->leftJoin('p.Branches branch')
    ->leftJoin('p.Usages usages')
    ->select('p.*, createdBy.username, COUNT(usages.anonymous_report_id) as count_usages')
    ->groupBy('p.id');
    $this->pluginPager = $this->getPager($query);
  }

  public function executeListMenu()
  {
    $this->newPlugins = $this->getListQuery('p')
    ->orderBy('p.created_at DESC')
    ->limit(7)
    ->fetchRecords();

    $this->popularPlugins = $this->getListQuery('p')
    ->leftJoin('p.Usages usages')
    ->select('p.*, COUNT(usages.anonymous_report_id) as count_usages')
    ->groupBy('p.id')
    ->orderBy('count_usages DESC')
    ->limit(7)
    ->fetchRecords();

    $this->preloadPages($this->newPlugins);
    $this->preloadPages($this->popularPlugins);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery('p')
    ->leftJoin('p.CreatedBy createdBy')
    ->leftJoin('p.Usages usages')
    ->select('p.*, createdBy.username, COUNT(usages.anonymous_report_id) as count_usages')
    ->groupBy('p.id');
    $this->plugin = $this->getRecord($query);
  }

  public function executeTitle()
  {
    // Your code here
  }

  public function executeFormCreate()
  {
    $this->form = $this->forms['Plugin'];
  }

  public function executeFormEdit()
  {
    $this->form = $this->forms['Plugin'];
    $this->plugin = $this->form->getObject();
  }


}
