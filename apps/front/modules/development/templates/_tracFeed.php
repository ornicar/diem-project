<?php use_helper('Date');

if(!isset($items))
{
  return;
}

echo £o('ul');

foreach($items as $item)
{
  echo £('li.clickable',
    £link($item->getLink())
    ->text($item->getTitle())
    ->set('.block').
    £('span.quiet.little',
      format_date($item->getPubDate(), 'd/MM H:mm').
      ' : '.
      dmString::truncate(
        strip_tags($item->getDescription()),
        400,
        £link($item->getLink())->text(' ...')->title(__('Read more')))
    )
  );
}

echo £c('ul');