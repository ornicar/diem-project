<?php use_helper('Date');

if(!isset($items))
{
  return;
}

echo £o('ul');

foreach($items as $item)
{
  echo _tag('li.clickable',
    _link($item->getLink())
    ->text($item->getTitle())
    ->set('.block').
    _tag('span.quiet.little',
      format_date($item->getPubDate(), 'd/MM H:mm').
      ' : '.
      dmString::truncate(
        strip_tags($item->getDescription()),
        400,
        _link($item->getLink())->text(' ...')->title(__('Read more')))
    )
  );
}

echo £c('ul');