<?php
/*
 * Action for Documentation : List menu
 * Vars : $docPager
 */

echo £o('nav.doc.list_menu.menu');

 echo $docPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($docPager as $doc)
  {
    echo £o('li.element');
    
      echo £link($doc);

      echo £o('ul');
      foreach($doc->Pages as $page)
      {
        echo £o('li');
        
          echo £link($page)
          ->title($page->resume)
          ->text($page->name);
        
          if (dm_current($page))
          {
            echo _tag('div.summary', $summary->render($page->moreRecentText));
          }
          
        echo £c('li');
      }
      echo £c('ul');
      
    echo £c('li');
  }

  echo £c('ul');

 echo $docPager->renderNavigationBottom();

echo £c('nav');