<?php
use_javascript('lib.ui-core');
use_javascript('lib.ui-widget');
use_javascript('lib.ui-tabs');
use_stylesheet('ui-lightness/jquery-ui-1.8rc3.custom');

echo _tag('div.clearfix',

  _link('@plugin_rss')
  ->text('Diem plugins syndication')
  ->title('Subscribe to the plugins feed')
  ->set('.rss_link').

  _tag('h1.t_big', $plugin->name)
);

echo _tag('h2.t_baseline', $plugin->resume);

echo _tag('div.tabs',
  _tag('ul',
    _tag('li', _tag('a href=#plugin-overview', 'Overview')).
    _tag('li', _tag('a href=#plugin-documentation', 'Documentation')).
    _tag('li', _tag('a href=#plugin-comments', 'Comments')).
    _tag('li', _tag('a href=#plugin-issues', 'Issues')).
    _tag('li', _tag('a href=#plugin-changelog', 'Changelog'))
  ).
  _tag('div#plugin-overview', get_partial('plugin/_overview', array('plugin' => $plugin))).
  _tag('div#plugin-documentation', markdown($plugin->readme)).
  _tag('div#plugin-comments', get_partial('plugin/_comments', array('plugin' => $plugin))).
  _tag('div#plugin-issues', get_partial('plugin/_issues', array('plugin' => $plugin))).
  _tag('div#plugin-changelog', get_partial('plugin/_changelog', array('plugin' => $plugin)))
);

echo _tag('p.mt10', sprintf('%s, created on %s by %s, used by %d projects',
  $plugin,
  format_date($plugin->createdAt, 'D'),
  $plugin->CreatedBy,
  $plugin->count_usages
));