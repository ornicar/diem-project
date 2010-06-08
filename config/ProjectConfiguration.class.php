<?php

require_once realpath(dirname(__FILE__).'/..').'/lib/vendor/diem/dmCorePlugin/lib/core/dm.php';
dm::start();

class ProjectConfiguration extends dmProjectConfiguration
{

  public function setup()
  {
    parent::setup();

    // Fix for nginx (http://diem-project.org/community/snippets/diem-and-nginx)
    if(isset($_SERVER['PATH_INFO']) && strpos($_SERVER['PATH_INFO'], '%2b'))
    {
      $_SERVER['PATH_INFO'] = urldecode($_SERVER['PATH_INFO']);
    }
    
    $this->enablePlugins(array(
      'dmWidgetGalleryPlugin',
      'dmWidgetTwitterPlugin',
      'dmWidgetFeedReaderPlugin',
      'dmContactPlugin',
      'dmGithubPlugin',
      'dmTagPlugin',
      'dmSqlBackupPlugin',
      'dmBotPlugin'
    ));

    $this->setWebDir(realpath(dirname(__FILE__).'/..').'/public_html');
  }
  
  public function setupPlugins()
  {
  }
}
