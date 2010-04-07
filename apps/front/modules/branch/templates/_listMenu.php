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
      echo £c('ul');
      
    echo £c('li');
  }

  echo £c('ul');

 echo $branchPager->renderNavigationBottom();

echo £c('nav');