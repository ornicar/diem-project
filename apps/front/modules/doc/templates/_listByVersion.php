<?php
/*
 * Action for Documentation : List by version
 * Vars : $docPager
 */

echo £o('div.doc.list_by_version');

 echo $docPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($docPager as $doc)
  {
    echo £o('li.element');
    
      echo _link($doc);
      
    echo £c('li');
  }

  echo £c('ul');

 echo $docPager->renderNavigationBottom();

echo £c('div');