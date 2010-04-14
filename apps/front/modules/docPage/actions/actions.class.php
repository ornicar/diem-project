<?php
/**
 * Documentation page actions
 */
class docPageActions extends dmFrontModuleActions
{
  // handle GitHub post-receive hook
  public function executeUpdateFromGit(dmWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $repoDir = sfConfig::get('sf_root_dir').'/data/diem-docs';

    // include phpGitRepo
    require_once(sfConfig::get('sf_root_dir').'/lib/vendor/php-git-repo/lib/phpGitRepo.php');

    // create a git repo instance
    $repo = new phpGitRepo($repoDir);

    // run the synchronizer passing it the repo instance
    $synchronizer = new gitDocumentationSynchronizer($repo);
    $synchronizer->execute();

    return $this->renderText('done');
  }

}