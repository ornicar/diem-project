<?php
/*
 * Action for Branch : List menu
 * Vars : $branchPager
 */

echo £o('nav.branch.list_menu.menu');

 echo $branchPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($branchPager as $branch)
  {
    echo £o('li.element');
    
      echo _tag('a.link', $branch);
      
      echo £o('ul');
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