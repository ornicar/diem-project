<?php
/*
 * Action for Site using Diem : List
 * Vars : $sitePager
 */

echo _open('div.site.list');

 echo $sitePager->renderNavigationTop();

  echo _open('ul.elements.clearfix');

  $it = 1;
  foreach ($sitePager as $site)
  {
    echo _open('li.element.clickable');
    
      echo _tag('h2.t_medium', $site->name);

      echo _tag('div.content.clearfix',
        ($site->Media
          ? _link($site->url)->text(_media($site->Media)->alt($site->Media->legend ? $site->Media->legend : $site->name)->width(200))
          : ''
        ).
        markdown($site->text).
        _tag('p.version', 'Diem '._tag('strong', $site->diemVersion))
      );
      
    echo _close('li');

    if (++$it%2) echo _tag('li.clearboth');
  }

  echo _close('ul');

 echo $sitePager->renderNavigationBottom();

echo _close('div');