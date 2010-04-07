<?php

echo _tag('div.clearfix',

  _link('@blog_rss')
  ->text('Diem blog syndication')
  ->title('Subscribe to the blog feed')
  ->set('.rss_link').

  _tag('h1.t_big', 'Blog')

);