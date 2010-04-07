<?php
use_javascript('lib.dataTable');
use_stylesheet('ui-lightness/jquery-ui-1.8rc3.custom');
use_stylesheet('dataTable');

// Plugin : List
// Vars : $pluginPager

$table = _table('.data_table')->head(
  __('Plugin'),
  __('Status'),
  __('Users'),
  __('Author'),
  __('Created')
);

foreach ($pluginPager as $plugin)
{
  $table->body(

    _tag('h2.t_plugin', _link($plugin))._tag('p', $plugin->resume),

    //implode(', ', $plugin->brancheNumbers),

    _media($plugin->isDone ? 'check.png' : 'gear.png')
    ->alt($plugin->isDone ? 'Ready' : 'Work in progress'),

    $plugin->count_usages,

    $plugin->CreatedBy->username,

    date('Y/m/d', strtotime($plugin->createdAt))

  );
}

echo $table;