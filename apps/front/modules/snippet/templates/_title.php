<?php
// Snippet : Title

echo £('div.clearfix',

  £link('@snippet_rss')
  ->text('Diem snippets syndication')
  ->title('Subscribe to the snippets feed')
  ->set('.rss_link').

  £('h1.t_big', __('User snippets'))

);