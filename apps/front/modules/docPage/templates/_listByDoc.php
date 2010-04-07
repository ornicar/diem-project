<?php
/*
 * Action for Documentation page : List by doc
 * Vars : $docPagePager
 */

echo _open('nav.doc_page.list_by_doc');

 echo $docPagePager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($docPagePager as $docPage)
  {
    echo _open('li.element.mb5');
    
      echo _link($docPage)->text(
        $docPage->name.
        _tag('span.quiet.ml10', $docPage->resume)
      )->set('.no_underline');
      
    echo £c('li');
  }

  echo £c('ul');

 echo $docPagePager->renderNavigationBottom();

echo £c('nav');