<?php

use_stylesheet('hudson');

echo _open('div.hudson_padding');

echo _tag('h2.t_box', __('Continuous integration'));

echo _open('div.latest_builds');
echo _tag('p', 'Latest builds:');
for($it=0; $it<5; $it++)
{
  $item = $items[$it];

  echo _link($item->getLink())
  ->text($item->getTitle())
  ->set(strpos($item->getTitle(), 'SUCCESS') ? '.success' : '.failure');
}
echo _close('div')._close('div');

echo _tag('span.block.text_align_center', 'Tests');
echo _link('http://ci.diem-project.org/job/diem_5.0/test/?width=800&height=600&failureOnly=false')
->text(_media('http://ci.diem-project.org/job/diem_5.0/test/trend?width=278&height=200')->size(278, 200))
->title('Diem 5.0 Continuous Integration Tests');

echo _tag('span.block.text_align_center', 'Trend');
echo _link('http://ci.diem-project.org/job/diem_5.0/buildTimeTrend')
->text(_media('http://ci.diem-project.org/job/diem_5.0/buildTimeGraph/png?width=278&height=200')->size(278, 200))
->title('Diem 5.0 Continuous Integration Trend');

echo _tag('p.hudson_padding',
  _link('http://twitter.com/diem_build')
  ->text(_media('twitter.png')->size(24, 24).' Follow Diem builds on twitter').
  _link('http://ci.diem-project.org/rssAll')
  ->text(_media('rss24.png')->size(24, 24).' Subscribe to Builds RSS')
);