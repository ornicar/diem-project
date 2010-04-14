<?php
/**
 * Documentation page actions
 */
class docPageActions extends dmFrontModuleActions
{
  public function executeUpdateFromGit(dmWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $synchronizer = $this->getService('git_documentation_synchronizer');

    $synchronizer->setOption('local_repo_dir', sfConfig::get('sf_root_dir').'/data/diem-docs');
    
    $synchronizer->execute();

    return $this->renderText('done');
  }

}