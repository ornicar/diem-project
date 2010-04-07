<?php

class migrateToI18nTask extends dmContextTask
{
  protected
  $oldDb;
  
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->namespace = 'my';
    $this->name = 'migrate-to-i18n';
    $this->briefDescription = 'Handle the ALPHA6 compatibility break';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->oldDb = new oldDb('mysql:dbname=diem_project_before_i18n;host=localhost', 'root', 'm');
    
    $this->withDatabase();
    
//    $this->migrateUnchangedModels();

//    $this->copyModels('DmSetting DmSettingTranslation');

    new DmPage;
    $this->copyModels('DmPageTranslation');
    
//    $this->copyI18nModel('DmAutoSeo');
//    
//    $this->copyI18nModel('DmWidget');
//    
//    $this->copyI18nModel('Doc');
//    
//    $this->copyI18nModel('DocPage');
  }
  
  protected function copyI18nModel($model)
  {
    $table = dmDb::table($model);
    
    $this->log('Empty '.$model);
    $table->createQuery()->delete()->execute();
    
    $records = new myDoctrineCollection($table);
    
    $this->log('Copy '.$model);
    foreach($this->oldDb->getData($table->getTableName()) as $array)
    {
      $records->add($table->create(array_merge(
        $array,
        array('lang' => 'en')
      )));
    }
    
    $records->save();
  }
  
  protected function migrateUnchangedModels()
  {
    throw new dmException('hey, no !');
    
    foreach(dmProject::getAllModels() as $model)
    {
      $this->log('Empty '.$model);
      dmDb::query($model)->delete()->execute();
    }
    
    $this->copyModels('DmMediaFolder DmLayout DmPage DmPermission DmGroup DmUser');
    
    $this->copyModels('DmGroupPermission DmuserPermission DmUserGroup DmRememberKey');
    
    $this->copyModels('DmMedia DmPageView');
    
    $this->copyModels('DmArea DmZone DmWidget');
    
    $this->copyModels('Article Comment Site Branch Version Plugin PluginComment PluginBranch');
  }
  
  protected function copyModels($modelsString)
  {
    foreach(explode(' ', $modelsString) as $model)
    {
      $this->log('Copy '.$model);
      $this->copyModel($model);
    }
  }
  
  protected function copyModel($model)
  {
    $table = dmDb::table($model);
    $tableName = $table->getTableName();
    
    $vars = array();
    $placeholders = array();
    foreach($table->getColumns() as $columnName => $column)
    {
      $fields[] = $columnName;
      $placeholders[] = ':'.$columnName;
    }
    
    $conn = Doctrine_Manager::connection();
    
    $stmt = $conn->prepare(sprintf('INSERT INTO %s (%s) VALUES (%s)',
      $tableName,
      implode(',', $fields),
      implode(',', $placeholders)
    ))->getStatement();
    
    $conn->beginTransaction();
    
    try
    {
      foreach($this->oldDb->getData($tableName) as $array)
      {
        $values = array();
        foreach($fields as $field)
        {
          $values[':'.$field] = isset($array[$field]) ? $array[$field] : '';
        }
        $stmt->execute($values);
      }
    }
    catch(Exception $e)
    {
      dmDebug::show($model, $array);
      throw $e;
    }
    
    $conn->commit();
  }
  
  protected function getChangedModels()
  {
    return array(
      'Doc',
      'DocPage',
      'DmAutoSeo',
      'DmWidget',
      'DmMailTemplate'
    );
  }
  
  protected function getUnchangedModels()
  {
    return array_diff(dmProject::getAllModels(), $this->getChangedModels());
  }
}

class oldDb
{
  protected
  $conn;
  
  public function __construct($dsn, $user, $password)
  {
    $pdo = new PDO($dsn, $user, $password);
    
    $pdo->exec('SET CHARACTER SET utf8');
    
    $this->conn = Doctrine_Manager::getInstance()->openConnection($pdo, 'old', false);
  }
  
  public function getData($tableName)
  {
    return dmDb::pdo('SELECT * FROM '.$tableName, array(), $this->conn)->fetchAll(Doctrine::FETCH_ASSOC);
  }
}