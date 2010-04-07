<?php use_helper('Date');

echo £o('div.snippet.list');

  if ($sf_user->getFlash('form_saved'))
  {
    echo _tag('p.mt20.mb20', 'Thanks for your snippet !');
  }

 echo $snippetPager->renderNavigationTop();

  $table = £table()->head(
    __('Snippet'),
    __('Date'),
    __('Author')
  );

  foreach ($snippetPager as $snippet)
  {
    $table->body(
      _tag('h2.t_plugin', _link($snippet)->text(escape($snippet->name))),
      format_date($snippet->createdAt, 'd'),
      escape($snippet->createdBy)
    );
  }

  echo $table;

 echo $snippetPager->renderNavigationBottom();

echo £c('div');