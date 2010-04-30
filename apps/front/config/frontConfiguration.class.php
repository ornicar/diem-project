<?php

require_once(dm::getDir().'/dmFrontPlugin/lib/config/dmFrontApplicationConfiguration.php');

class frontConfiguration extends dmFrontApplicationConfiguration
{

  public function configure()
  {
    $this->getEventDispatcher()->connect('dm.search.filter_boost_values', array($this, 'listenToSearchFilterBoostValues'));

    $this->getEventDispatcher()->connect('dm.page_cache.enable', array($this, 'listenToPageCacheEnable'));
  }

  public function listenToPageCacheEnable(sfEvent $event, $enable)
  {
    if($enable)
    {
      $uri = $_SERVER['REQUEST_URI'];

      if(0 === strncmp($uri, '/security', 9))
      {
        $enable = false;
      }
      if(0 === strncmp($uri, '/contact', 8))
      {
        $enable = false;
      }
    }

    return $enable;
  }

  public function listenToSearchFilterBoostValues(sfEvent $event, array $boostValues)
  {
    $page = $event['page'];
    
    if($page->isModuleAction('version', 'show'))
    {
      $boostValues['body'] = 0;
    }
    elseif($page->isModuleAction('docPage', 'show'))
    {
      $boostValues['body'] = 3;
    }

    if($page->isModuleAction('doc', 'show') || $page->isModuleAction('docPage', 'show'))
    {
      if($page->getRecord()->getAncesTorRecord('Branch')->get('number') != sfConfig::get('app_branches_current'))
      {
        throw new dmSearchPageNotIndexableException();
      }
    }

    return $boostValues;
  }
}
