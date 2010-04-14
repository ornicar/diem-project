<?php

/**
 * Pull documentation from Git server to a local Git repo,
 * and update documentation in database
 */
class GitDocumentationSynchronizer extends dmConfigurable
{
  public function __construct(array $options)
  {
    $this->configure($options);
  }

  /**
   * Run synchronization
   */
  public function execute()
  {
    $this->configure();
    
    $this->checkLocalRepo();

    $this->pullFromRemote();

    $this->updateDatabase();
  }

  /**
   * Verify that the local repo is a valid Git repo
   */
  protected  function checkLocalRepo()
  {
    if(!is_dir($this->getOption('local_repo_dir').'/.git'))
    {
      throw new RuntimeException($this->getOption('local_repo_dir').' is not a valid git repository');
    }
  }

  /**
   * Pull changes from remote repo to local repo
   */
  protected function pullFromRemote()
  {
    $command = sprintf(
      'cd %s && git pull %s %s',
      escapeshellarg($this->getOption('local_repo_dir')),
      escapeshellarg($this->getOption('remote')),
      escapeshellarg($this->getOption('branch'))
    );

    exec($command, $output, $returnVar);

    if(0 != $returnVar)
    {
      throw new RuntimeException(sprintf(
        '%s returns %s: %s',
        $command,
        $returnVar,
        implode("\n", $output)
      ));
    }
  }

  /**
   * Update changed documentation pages in database
   */
  protected function updateDatabase()
  {
    $versions = dmDb::query('Branch b')
    ->select('b.number')
    ->fetchFlat();

    $types = dmDb::query('Doc d')
    ->select('d.type')
    ->distinct()
    ->fetchFlat();

    $cultures         = sfConfig::get('dm_i18n_cultures');
    $originalCulture  = sfDoctrineRecord::getDefaultCulture();

    foreach($versions as $version)
    {
      foreach($types as $type)
      {
        foreach($cultures as $culture)
        {
          sfDoctrineRecord::setDefaultCulture($culture);

          $dir    = dmOs::join($this->getOption('local_repo_dir'), $version, $type, $culture);
          $files  = sfFinder::type('file')->name('/^\d{2}\s-\s.+\.markdown$/')->in($dir);

          foreach($files as $file)
          {
            $docName = preg_replace('/^\d{2}\s-\s(.+)\.markdown$/', '$1', basename($file));

            $docRecord = dmDb::query('DocPage dp')
            ->withI18n()
            ->innerJoin('dp.Doc doc')
            ->innerJoin('doc.Branch branch')
            ->where('branch.number = ?', $version)
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
    }
    
    sfDoctrineRecord::setDefaultCulture($originalCulture);
  }
}