<?php use_helper('Date');

/*
 * An $item is an array containing:
 * - title:       title of the feed item
 * - link:        url of the feed item
 * - content:     HTML content
 * - pub_date:    item publication date (timestamp)
 */

echo _open('ul');

foreach($items as $item)
{
  echo _tag('li.clickable',
    _link($item['link'])
    ->text($item['title'])
    ->set('.block').
    _tag('span.quiet.little',
      format_date($item['pub_date'], 'd/MM H:mm').
      ' by '.
      trim($item['author_name'], ')').
      '<br />'.
      dmString::truncate(strip_tags($item['content']), 100)
    )
  );
}

echo _close('ul');