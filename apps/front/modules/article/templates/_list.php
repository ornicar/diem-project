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
    
      echo £('h2.t_medium', $article->name);
      
      echo £('p.article_infos',
        £link($article)->text(__('» read more'))->set('.fright').
        £('span', format_date($article->createdAt, 'D')).' by '.$article->CreatedBy
      );
      
      echo £('p', $article->resume);
      
    echo £c('article').£c('li');
  }

  echo £c('ul');

 echo $articlePager->renderNavigationBottom();

echo £c('div');