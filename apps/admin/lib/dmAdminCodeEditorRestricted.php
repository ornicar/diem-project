<?php

class dmAdminCodeEditorRestricted extends dmAdminCodeEditor
{

  public function initialize(array $options)
  {
    parent::initialize($options);

    $this->mergeOption('file_black_list', array(
      'config/databases.yml',
      'config/properties.ini',
      'apps/front/config/app.yml',
      'cache/.*',
      'log/.*',
      'data/.*',
      '.*/settings.yml'
    ));
  }

  public function validateSaveFile($file)
  {
    throw new dmCodeEditorException('You are not allowed to save a file in this demo site.');
  }
}