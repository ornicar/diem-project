<?php

class fixHelperTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();

    $this->namespace = 'my';
    $this->name = 'fix-helpers';
    $this->briefDescription = 'Replace £ based helpers';

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
      'Plugin'      => 'text readme',
      'Snippet'     => 'text'
    );
  }

  protected function getReplacements()
  {
    return array(
      '->£(' => '->tag(',
      '->£o(' => '->open(',
      '->£c(' => '->close(',
      '->£link(' => '->link(',
      '->£media(' => '->media(',
      '->£table' => '->table(',
      '£(' => '_tag(',
      '£o(' => '_open(',
      '£c(' => '_close(',
      '£link(' => '_link(',
      '£media(' => '_media(',
      '£table(' => '_table('
    );
  }
}