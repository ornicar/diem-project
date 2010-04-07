<?php

class openPackageTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->namespace = 'my';
    $this->name = 'open-package';
    $this->briefDescription = 'Builds a package of the project and save it in the upload dir';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $filesystem = $this->get('filesystem');
    
    $uploadDir = dmOs::join(sfConfig::get('sf_web_dir'), 'uploads');
    if (!$filesystem->mkdir($uploadDir))
    {
      throw new dmException(dmProject::unRootify($uploadDir).' is not writable');
    }
    
    $cacheDir = dmOs::join(sfConfig::get('sf_cache_dir'), 'open_package', dmProject::getKey());
    if (!$filesystem->mkdir($cacheDir))
    {
      throw new dmException(dmProject::unRootify($cacheDir).' is not writable');
    }
    $filesystem->deleteDirContent($cacheDir);
    
    if (file_exists(dmOs::join($uploadDir, dmProject::getKey().'.tgz')))
    {
      $filesystem->unlink(dmOs::join($uploadDir, dmProject::getKey().'.tgz'));
    }
    
    $this->log('Building the package, please wait...');

    $finder = sfFinder::type('all')
    ->prune(array('.thumbs'))
    ->discard(array('.thumbs'));
    
    foreach(array('apps', 'config', 'lib', 'plugins', 'public_html', 'test') as $dir)
    {
      $filesystem->mirror(
        dmOs::join(sfConfig::get('sf_root_dir'), $dir),
        dmOs::join($cacheDir, $dir),
        $finder
      );
    }
    
    $filesystem->copy(dmOs::join(sfConfig::get('sf_root_dir'), 'symfony'), dmOs::join($cacheDir, 'symfony'));
    
    foreach(array('cache', 'data') as $dir)
    {
      $filesystem->mkdir(dmOs::join($cacheDir, $dir));
    }
    
    if (file_exists(dmOs::join(sfConfig::get('sf_data_dir'), 'mysql')))
    {
      $filesystem->mirror(dmOs::join(sfConfig::get('sf_data_dir'), 'mysql'), dmOs::join($cacheDir, 'data/mysql'), sfFinder::type('all'));
    }
    
    $databasesFile = dmOs::join($cacheDir, 'config/databases.yml');
    $databasesConfig = sfYaml::load($databasesFile);
    
    foreach($databasesConfig as $namespace => $nsConfig)
    {
      foreach($nsConfig as $dbName => $config)
      {
        $dsn = $databasesConfig[$namespace][$dbName]['param']['dsn'];
        $databasesConfig[$namespace][$dbName]['param']['dsn'] = preg_replace('#//(.+)\:(.*)@#', '//#DB_USER#:#DB_PASSWORD#@', $dsn);
      
        foreach(array('username', 'password') as $key)
        {
          if(isset($databasesConfig[$namespace][$dbName]['param'][$key]))
          {
            unset($databasesConfig[$namespace][$dbName]['param'][$key]);
          }
        }
      }
      
      file_put_contents($databasesFile, sfYaml::dump($databasesConfig, 5));
    }
    
    $filesystem->unlink(dmOs::join($cacheDir, 'test/functional'));
    
    $command = 'cd '.dirname($cacheDir).'; tar -czf '.dmProject::getKey().'.tgz '.dmProject::getKey();

    $this->logSection('Compression', $command);
    
    if (!$filesystem->exec($command))
    {
      throw new dmException($filesystem->getLastExec('output'));
    }
    
    rename(dmOs::join(dirname($cacheDir), dmProject::getKey().'.tgz'), dmOs::join($uploadDir, dmProject::getKey().'.tgz'));
    
    $filesystem->unlink($cacheDir);

    $this->logBlock('Done !', 'INFO');
  }
}