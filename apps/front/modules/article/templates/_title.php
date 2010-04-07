<?php

echo £('div.clearfix',

  £link('@blog_rss')
  ->text('Diem blog syndication')
  ->title('Subscribe to the blog feed')
  ->set('.rss_link').

  £('h1.t_big', 'Blog')

);