<?php
// Plugin : Title

echo £('div.clearfix',

  £link('@plugin_rss')
  ->text('Diem plugins syndication')
  ->title('Subscribe to the plugins feed')
  ->set('.rss_link').

  £('h1.t_big', 'Plugins')

);