<?php
/*
 * Action for Branch : List menu
 * Vars : $branchPager
 */

echo _open('nav.branch.list_menu.menu');

 echo $branchPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($branchPager as $branch)
  {
    echo _open('li.element');
    
      echo _tag('a.link', $branch);
      
      echo _open('ul');
      foreach($branch->Versions as $version)
      {
        echo _tag('li', _link($version)->title($version->resume));
      }
      echo _close('ul');
      
    echo _close('li');
  }

  echo _close('ul');

 echo $branchPager->renderNavigationBottom();

echo _close('nav');