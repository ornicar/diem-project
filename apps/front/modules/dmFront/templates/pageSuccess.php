<?php

echo _open('div#dm_page'.($sf_user->getIsEditMode() ? '.edit' : ''));

echo $helper->renderAccessLinks();

  echo _tag('div.dm_layout',

    $helper->renderArea('layout.top', '.clearfix').

    _tag('div.dm_layout_center.clearfix',

//      $helper->renderArea('layout.left').

      $helper->renderArea('page.content', '.clearfix').

      $helper->renderArea('layout.right')

    ).

    $helper->renderArea('layout.bottom', '.clearfix')

  );

echo _close('div');