<?php
/**
 * Development components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class developmentComponents extends myFrontModuleComponents
{

  public function executeHudsonBox()
  {
    $cache = $this->context->get('cache_manager')->getCache('feed');
    if ($cache->has('hudson-last'))
    {
      $this->items = $cache->get('hudson-last');
    }
    elseif(!sfConfig::get('dm_search_populating'))
    {
      $url = 'http://ci.diem-project.org/rssAll';
      $this->items = sfFeedPeer::createFromWeb($url)->getItems();
      $cache->set('hudson-last', $this->items, 10800);
    }
  }
}
