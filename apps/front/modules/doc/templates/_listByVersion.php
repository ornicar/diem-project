<?php
/*
 * Action for Documentation : List by version
 * Vars : $docPager
 */

echo _open('div.doc.list_by_version');

 echo $docPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($docPager as $doc)
  {
    echo _open('li.element');
    
      echo _link($doc);
      
    echo £c('li');
  }

  echo £c('ul');

 echo $docPager->renderNavigationBottom();

echo £c('div');