<?php
// Snippet : List menu
// Vars : $snippetPager

echo £o('div.snippet.list_menu');

 echo $snippetPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($snippetPager as $snippet)
  {
    echo £o('li.element');

      echo £link($snippet)->text(escape($snippet->name));

    echo £c('li');
  }

  echo £c('ul');

 echo $snippetPager->renderNavigationBottom();

echo £c('div');