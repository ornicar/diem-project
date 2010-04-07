<?php
/*
 * Action for Article : List menu
 * Vars : $articlePager
 */

echo £o('nav.article.list_menu');

 echo $articlePager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($articlePager as $article)
  {
    echo £o('li.element');
    
      echo _link($article)->title($article->resume);
      
    echo £c('li');
  }

  echo £c('ul');

 echo $articlePager->renderNavigationBottom();

echo £c('nav');