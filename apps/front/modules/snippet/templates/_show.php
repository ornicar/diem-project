<?php use_helper('Date');
// Snippet : Show
// Vars : $snippet

echo £o('div.snippet.show');

  echo _tag('div.clearfix',
  
    _link('@snippet_rss')
    ->text('Diem snippets syndication')
    ->title('Subscribe to the snippets feed')
    ->set('.rss_link').

    _tag('h1.t_big', escape($snippet->name))
  );
  
  echo _tag('p.snippet_infos', _tag('span', format_date($snippet->createdAt, 'D')).' by '.escape($snippet->createdBy));
  
  echo _tag('div.markdown', $snippetHtml);
  
echo £c('div');