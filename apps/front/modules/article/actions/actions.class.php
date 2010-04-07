<?php
/**
 * Article actions
 */
class articleActions extends myFrontModuleActions
{
// test

  public function executeRss(dmWebRequest $request)
  {
    $records = dmDb::query('Article a')
    ->where('a.is_active = ?', true)
    ->orderBy('a.created_at DESC')
    ->limit(20)
    ->fetchRecords();

    $this->preloadPages($records);

    $feed = new sfRssFeed();

    $feed->setTitle('Diem Project Blog');
    $feed->setLink('http://diem-project.org/blog');
    $feed->setAuthorName('Thibault Duplessis');

    foreach ($records as $record)
    {
      $item = new sfFeedItem();
      $item->setTitle($record->name);
      $item->setLink($this->getHelper()->£link($record)->getAbsoluteHref());
      $item->setAuthorName($record->CreatedBy->username);
      $item->setPubdate($record->getDateTimeObject('created_at')->format('U'));
      $item->setUniqueId($record->name.' ('.$record->id.')');
      
      $item->setDescription(
        $this->context->get('markdown')->toHtml($record->text)
      );

      $feed->addItem($item);
    }

    $this->feed = $feed;
  }
}
