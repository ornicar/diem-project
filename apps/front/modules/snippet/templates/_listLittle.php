<?php use_helper('Date');

echo £o('div.snippet.list');

  if ($sf_user->getFlash('form_saved'))
  {
    echo _tag('p.mt20.mb20', 'Thanks for your snippet !');
  }

  echo $snippetPager->renderNavigationTop();

  echo £o('ul');
 
  foreach ($snippetPager as $snippet)
  {
    echo _tag('li.mb10.clickable',
      _link($snippet)->set('.block').
      _tag('span.quiet', escape($snippet->createdBy).' - '.format_date($snippet->createdAt, 'D'))
    );
  }

  echo £c('ul');

  echo $snippetPager->renderNavigationBottom();

echo £c('div');