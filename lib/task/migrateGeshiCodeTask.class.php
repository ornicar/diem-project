<?php

class migrateGeshiCodeTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->namespace = 'my';
    $this->name = 'migrate-geshi-code';
    $this->briefDescription = '<code:php> -> [code php]';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->withDatabase();
    
    foreach(array('DocPage' => 'text', 'Plugin' => 'readme', 'DmWidget' => 'value') as $model => $field)
    {
      $this->updateModel($model, $field);
    }
  }
  
  protected function updateModel($model, $field)
  {
    foreach(dmDb::table($model)->findAll() as $record)
    {
      $oldValue = $record->$field;
      
      $newValue = $this->convert($oldValue);
      
      if($oldValue !== $newValue)
      {
        $record->$field = $newValue;
        $this->log('Updated '.$record);
        $record->save();
      }
    }
  }
  
  protected function convert($text)
  {
    $text = str_replace('<code>', '[code]', $text);
    $text = str_replace('<code:php>', '[code php]', $text);
    $text = str_replace('</code>', '[/code]', $text);
    
    return $text;
  }

}