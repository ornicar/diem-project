<?php
/*
 * Action for Documentation page : List by doc
 * Vars : $docPagePager
 */

echo £o('nav.doc_page.list_by_doc');

 echo $docPagePager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($docPagePager as $docPage)
  {
    echo £o('li.element.mb5');
    
      echo _link($docPage)->text(
        $docPage->name.
        _tag('span.quiet.ml10', $docPage->resume)
      )->set('.no_underline');
      
    echo £c('li');
  }

  echo £c('ul');

 echo $docPagePager->renderNavigationBottom();

echo £c('nav');