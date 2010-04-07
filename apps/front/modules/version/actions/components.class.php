<?php
/**
 * Version components
 * 
 * Components are micro-controllers that prepare data for a template.
 * You should not use redirection or database manipulation ( insert, update,
 * delete ) here.
 * To make redirections or manipulate database, use the actions class.
 * 
 */
class versionComponents extends dmFrontModuleComponents
{

  public function executeListDownload()
  {
    $query = $this->getListQuery('v')
    ->where('v.is_best = ?', true)
    ->leftJoin('v.Branch b')
    ->groupBy('b.id')
    ->orderBy('b.position asc');
    
    $this->versionPager = $this->getPager($query);
    
    $this->latestVersion = $this->versionPager->getCurrent();
  }

  public function executeShow()
  {
    $query = $this->getShowQuery('v');
    $this->version = $this->getRecord($query);

    if($tag = $this->version->githubTag)
    {
      $api = new phpGitHubApi();
      $this->commits = $api->listBranchCommits('diem-project', 'diem', $this->version->githubTag);
    }
  }

  public function executeListMenu()
  {
    $query = $this->getListQuery('v')
    ->leftJoin('v.Whatsnew w')
    ->leftJoin('v.Changelog c')
    ->leftJoin('v.Docs d');
    $this->versionPager = $this->getPager($query);
  }

  public function executeVersionMenu()
  {
    // Your code here
  }


}
