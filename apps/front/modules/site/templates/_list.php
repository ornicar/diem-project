<?php
/*
 * Action for Site using Diem : List
 * Vars : $sitePager
 */

echo £o('div.site.list');

 echo $sitePager->renderNavigationTop();

  echo £o('ul.elements.clearfix');

  $it = 1;
  foreach ($sitePager as $site)
  {
    echo £o('li.element.clickable');
    
      echo £('h2.t_medium', $site->name);

      echo £('div.content.clearfix',
        ($site->Media
          ? £link($site->url)->text(£media($site->Media)->alt($site->Media->legend ? $site->Media->legend : $site->name)->width(200))
          : ''
        ).
        markdown($site->text).
        £('p.version', 'Diem '.£('strong', $site->diemVersion))
      );
      
    echo £c('li');

    if (++$it%2) echo £('li.clearboth');
  }

  echo £c('ul');

 echo $sitePager->renderNavigationBottom();

echo £c('div');