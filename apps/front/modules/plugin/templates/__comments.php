<?php

echo dm_get_widget('pluginComment', 'listByPlugin', array(
  'orderField'  => 'created_at',
  'orderType'   => 'asc',
  'pluginFilter' => $plugin->id
));

echo _tag('h2.t_medium', 'Add a comment');

echo dm_get_widget('pluginComment', 'form', array(
  'css_class' => 'comment'
));