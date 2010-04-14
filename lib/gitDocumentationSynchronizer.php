<?php

/**
 * Pull documentation from Git server to a local Git repo,
 * and update documentation in database
 */
class gitDocumentationSynchronizer extends dmConfigurable
{
  protected $repo;
  
  public function __construct(phpGitRepo $repo)
  {
    $this->repo = $repo;
  }

  /**
   * Run synchronization
   */
  public function execute()
  {
    $this->repo->git('fetch origin');
    
    foreach($this->getBranches() as $branch)
    {
      $this->checkoutBranch($branch);

      $this->updateBranch($branch);
      
      $this->updateDatabase($branch);
    }
  }

  protected function getBranches()
  {
    return dmDb::query('Branch b')->select('b.number')->fetchFlat();
  }

  /**
   * Pull changes from remote repo to local repo
   */
  protected function checkoutBranch($branch)
  {
    if($this->repo->hasBranch($branch))
    {
      $this->repo->git('checkout '.$branch);
    }
    else
    {
      $this->repo->git('checkout -b '.$branch.' origin/'.$branch);
    }
  }

  protected function updateBranch($branch)
  {
    $this->repo->git('pull origin '.$branch);
  }

  /**
   * Update changed documentation pages in database
   */
  protected function updateDatabase($branch)
  {
    $types = dmDb::query('Doc d')
    ->select('d.type')
    ->distinct()
    ->fetchFlat();

    $cultures         = sfConfig::get('dm_i18n_cultures');
    $originalCulture  = sfDoctrineRecord::getDefaultCulture();

    foreach($types as $type)
    {
      foreach($cultures as $culture)
      {
        sfDoctrineRecord::setDefaultCulture($culture);

        $dir    = dmOs::join($this->repo->getDir(), $type, $culture);
        $files  = sfFinder::type('file')->name('/^\d{2}\s-\s.+\.markdown$/')->in($dir);

        foreach($files as $file)
        {
          $docName = preg_replace('/^\d{2}\s-\s(.+)\.markdown$/', '$1', basename($file));

          $docRecord = dmDb::query('DocPage dp')
          ->withI18n()
          ->innerJoin('dp.Doc doc')
          ->innerJoin('doc.Branch branch')
          ->where('branch.number = ?', $branch)
          ->andWhere('doc.type = ?', $type)
          ->andWhere('dpTranslation.name = ?', $docName)
          ->fetchOne();

          if($docRecord)
          {
            $docText = file_get_contents($file);

            if($docRecord->text != $docText)
            {
              $docRecord->text = $docText;
              $docRecord->save();
            }
          }
        }
      }
    }
    
    sfDoctrineRecord::setDefaultCulture($originalCulture);
  }
}