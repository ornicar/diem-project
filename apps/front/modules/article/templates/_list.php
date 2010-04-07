<?php use_helper('Date');
/*
 * Action for Article : List
 * Vars : $articlePager
 */

echo £o('div.article.list');

 echo $articlePager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($articlePager as $article)
  {
    echo £o('li.element.clickable').£o('article');
    
      echo _tag('h2.t_medium', $article->name);
      
      echo _tag('p.article_infos',
        £link($article)->text(__('» read more'))->set('.fright').
        _tag('span', format_date($article->createdAt, 'D')).' by '.$article->CreatedBy
      );
      
      echo _tag('p', $article->resume);
      
    echo £c('article').£c('li');
  }

  echo £c('ul');

 echo $articlePager->renderNavigationBottom();

echo £c('div');