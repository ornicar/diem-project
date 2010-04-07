<?php
/*
 * Action for Documentation : List menu
 * Vars : $docPager
 */

echo _open('nav.doc.list_menu.menu');

 echo $docPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($docPager as $doc)
  {
    echo _open('li.element');
    
      echo _link($doc);

      echo _open('ul');
      foreach($doc->Pages as $page)
      {
        echo _open('li');
        
          echo _link($page)
          ->title($page->resume)
          ->text($page->name);
        
          if (dm_current($page))
          {
            echo _tag('div.summary', $summary->render($page->moreRecentText));
          }
          
        echo _close('li');
      }
      echo _close('ul');
      
    echo _close('li');
  }

  echo _close('ul');

 echo $docPager->renderNavigationBottom();

echo _close('nav');