<?php
/*
 * Action for Version : List menu
 * Vars : $versionPager
 */

echo _open('div.version.list_menu');

 echo $versionPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($versionPager as $version)
  {
    echo _open('li.element');
    
      echo _link($version);

      echo _open('ul');
        
        foreach($version->Docs as $doc)
          echo _tag('li', _link($doc));

        echo _tag('li', _link($version->Whatsnew));
        echo _tag('li', _link($version->Changelog));
        echo _tag('li', _link('main/download')->anchor($version->anchor));

      echo _close('ul');
      
    echo _close('li');
  }

  echo _close('ul');

 echo $versionPager->renderNavigationBottom();

echo _close('div');