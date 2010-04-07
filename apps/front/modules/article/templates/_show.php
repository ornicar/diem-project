<?php use_helper('Date'); use_javascript('retweet');
/*
 * Action for Article : Show
 * Vars : $article
 */

echo _open('article.article.show');

  echo _tag('div.clearfix',
  
    _link('@blog_rss')
    ->text('Diem blog syndication')
    ->title('Subscribe to the blog feed')
    ->set('.rss_link').

    _tag('h1.t_big', $article->name)
  );

  echo _tag('p.article_infos', _tag('span', format_date($article->createdAt, 'D')).' by '.$article->CreatedBy);
  
  echo markdown($article->text);
  
  echo _link($sf_context->getPage())
  ->text('♻')
  ->set('.retweet')
  ->title($article->name)
  ->currentSpan(false);
  
echo £c('article');
