<?php
/*
 * Action for Version : List menu
 * Vars : $versionPager
 */

echo £o('div.version.list_menu');

 echo $versionPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($versionPager as $version)
  {
    echo £o('li.element');
    
      echo £link($version);

      echo £o('ul');
        
        foreach($version->Docs as $doc)
          echo £('li', £link($doc));

        echo £('li', £link($version->Whatsnew));
        echo £('li', £link($version->Changelog));
        echo £('li', £link('main/download')->anchor($version->anchor));

      echo £c('ul');
      
    echo £c('li');
  }

  echo £c('ul');

 echo $versionPager->renderNavigationBottom();

echo £c('div');