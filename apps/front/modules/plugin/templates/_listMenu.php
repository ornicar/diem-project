<?php
// Plugin : List menu
// Vars : $pluginPager


echo _open('ul');

  echo _open('li');

    echo _tag('p.link', 'Recently added plugins');

    echo _open('ul');

    foreach ($newPlugins as $plugin)
    {
      echo _tag('li', _link($plugin)->text($plugin->name));
    }

    echo _close('ul');

  echo _close('li');

  echo _open('li');

    echo _tag('p.link', 'More popular plugins');

    echo _open('ul');

    foreach ($popularPlugins as $plugin)
    {
      echo _tag('li', _link($plugin)->text($plugin->name));
    }

    echo _close('ul');

  echo _close('li');

echo _close('ul');