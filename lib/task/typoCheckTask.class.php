<?php

class typoCheckTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->namespace = 'my';
    $this->name = 'typo-check';
    $this->briefDescription = 'Typo checker';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->withDatabase();
    
    foreach($this->getModelFields() as $model => $implodedFields)
    {
      $fields = explode(' ', $implodedFields);
      
      foreach(dmDb::table($model)->findAll() as $record)
      {
        $this->replace($record, $fields);
      }
    }
  }
  
  protected function replace(dmDoctrineRecord $record, array $fields)
  {
    foreach($fields as $field)
    {
      $oldValue = $record->get($field);
      
      $newValue = strtr($oldValue, $this->getReplacements());
      
      if ($oldValue != $newValue)
      {
        $this->log('Correct '.$record.'->'.$field);
        
        $record->set($field, $newValue);
        $record->save();
      }
    }
  }
  
  protected function getModelFields()
  {
    return array(
      'DocPage'     => 'name resume text',
      'Doc'         => 'name resume text',
      'Branch'      => 'name resume whatsnew',
      'Version'     => 'name resume text changelog',
      'Site'        => 'name text',
      'Article'     => 'name resume text',
      'DmWidget'    => 'value',
      'DmPage'      => 'name title description keywords',
      'Plugin'      => 'text readme',
      'Snippet'     => 'text'
    );
  }
  
  protected function getReplacements()
  {
    return array(
      'developper' => 'developer',
      'usefull' => 'useful',
      'powerfull' => 'powerful',
      'librairy' => 'library',
      'librairies' => 'libraries',
      'wich ' => 'which ',
      'developped' => 'developed',
      'Utils' => 'Tools',
      'flavoured' => 'flavored',
      'PostGreSQL' => 'PostgreSQL',
      ' (' => '(',
      ' )' => ')',
      ' !' => '!',
      ' :' => ':'
    );
  }
}