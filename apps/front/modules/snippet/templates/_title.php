<?php
// Snippet : Title

echo _tag('div.clearfix',

  £link('@snippet_rss')
  ->text('Diem snippets syndication')
  ->title('Subscribe to the snippets feed')
  ->set('.rss_link').

  _tag('h1.t_big', __('User snippets'))

);