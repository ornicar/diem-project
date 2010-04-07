<?php use_helper('Date');
/*
 * Action for Article : List
 * Vars : $articlePager
 */

echo _open('div.article.list');

 echo $articlePager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($articlePager as $article)
  {
    echo _open('li.element.clickable')._open('article');
    
      echo _tag('h2.t_medium', $article->name);
      
      echo _tag('p.article_infos',
        _link($article)->text(__('» read more'))->set('.fright').
        _tag('span', format_date($article->createdAt, 'D')).' by '.$article->CreatedBy
      );
      
      echo _tag('p', $article->resume);
      
    echo _close('article')._close('li');
  }

  echo _close('ul');

 echo $articlePager->renderNavigationBottom();

echo _close('div');