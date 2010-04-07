<?php
/*
 * Action for Branch : List
 * Vars : $branchPager
 */

echo _open('div.branch.list');

 echo $branchPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($branchPager as $branch)
  {
    echo _open('li.element.clickable');
    
      echo _tag('h2.t_medium', _link($branch));

      echo $branch->resume;
      
    echo _close('li');
  }

  echo _close('ul');

 echo $branchPager->renderNavigationBottom();

echo _close('div');