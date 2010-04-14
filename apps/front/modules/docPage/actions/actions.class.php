<?php
/**
 * Documentation page actions
 */
class docPageActions extends dmFrontModuleActions
{
  public function executeUpdateFromGit(dmWebRequest $request)
  {
    //$this->forward404Unless($request->isMethod('post'));

    // create a git repo
    require_once(sfConfig::get('sf_root_dir').'/lib/vendor/php-git-repo/lib/phpGitRepo.php');
    $repo = new phpGitRepo(sfConfig::get('sf_root_dir').'/data/diem-docs');

    // run the synchronizer
    $synchronizer = new gitDocumentationSynchronizer($repo);
    $synchronizer->execute();

    return $this->renderText('done');
  }

}