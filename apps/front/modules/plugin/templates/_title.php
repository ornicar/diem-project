<?php
// Plugin : Title

echo _tag('div.clearfix',

  £link('@plugin_rss')
  ->text('Diem plugins syndication')
  ->title('Subscribe to the plugins feed')
  ->set('.rss_link').

  _tag('h1.t_big', 'Plugins')

);