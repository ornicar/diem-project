<?php

use_stylesheet('hudson');

echo £o('div.hudson_padding');

echo _tag('h2.t_box', __('Continuous integration'));

echo £o('div.latest_builds');
echo _tag('p', 'Latest builds:');
for($it=0; $it<5; $it++)
{
  $item = $items[$it];

  echo £link($item->getLink())
  ->text($item->getTitle())
  ->set(strpos($item->getTitle(), 'SUCCESS') ? '.success' : '.failure');
}
echo £c('div').£c('div');

echo _tag('span.block.text_align_center', 'Tests');
echo £link('http://ci.diem-project.org/job/diem_5.0/test/?width=800&height=600&failureOnly=false')
->text(£media('http://ci.diem-project.org/job/diem_5.0/test/trend?width=278&height=200')->size(278, 200))
->title('Diem 5.0 Continuous Integration Tests');

echo _tag('span.block.text_align_center', 'Trend');
echo £link('http://ci.diem-project.org/job/diem_5.0/buildTimeTrend')
->text(£media('http://ci.diem-project.org/job/diem_5.0/buildTimeGraph/png?width=278&height=200')->size(278, 200))
->title('Diem 5.0 Continuous Integration Trend');

echo _tag('p.hudson_padding',
  £link('http://twitter.com/diem_build')
  ->text(£media('twitter.png')->size(24, 24).' Follow Diem builds on twitter').
  £link('http://ci.diem-project.org/rssAll')
  ->text(£media('rss24.png')->size(24, 24).' Subscribe to Builds RSS')
);