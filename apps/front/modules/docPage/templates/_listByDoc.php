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
      
    echo _close('li');
  }

  echo _close('ul');

 echo $docPagePager->renderNavigationBottom();

echo _close('nav');

echo _tag('hr').markdown('The documentation is [hosted on GitHub](http://github.com/diem-project/diem-docs/tree/'.$docPage->Doc->Branch->number.' "Diem documentation on GitHub"). Feel free to submit issues and patches!');