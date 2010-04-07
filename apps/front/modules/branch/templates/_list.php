<?php
/*
 * Action for Branch : List
 * Vars : $branchPager
 */

echo £o('div.branch.list');

 echo $branchPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($branchPager as $branch)
  {
    echo £o('li.element.clickable');
    
      echo _tag('h2.t_medium', £link($branch));

      echo $branch->resume;
      
    echo £c('li');
  }

  echo £c('ul');

 echo $branchPager->renderNavigationBottom();

echo £c('div');