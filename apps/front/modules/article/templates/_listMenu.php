<?php
/*
 * Action for Article : List menu
 * Vars : $articlePager
 */

echo _open('nav.article.list_menu');

 echo $articlePager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($articlePager as $article)
  {
    echo _open('li.element');
    
      echo _link($article)->title($article->resume);
      
    echo _close('li');
  }

  echo _close('ul');

 echo $articlePager->renderNavigationBottom();

echo _close('nav');