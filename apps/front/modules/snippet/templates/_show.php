<?php use_helper('Date');
// Snippet : Show
// Vars : $snippet

echo £o('div.snippet.show');

  echo £('div.clearfix',
  
    £link('@snippet_rss')
    ->text('Diem snippets syndication')
    ->title('Subscribe to the snippets feed')
    ->set('.rss_link').

    £('h1.t_big', escape($snippet->name))
  );
  
  echo £('p.snippet_infos', £('span', format_date($snippet->createdAt, 'D')).' by '.escape($snippet->createdBy));
  
  echo £('div.markdown', $snippetHtml);
  
echo £c('div');