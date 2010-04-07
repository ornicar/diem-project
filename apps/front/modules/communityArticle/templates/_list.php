<?php use_helper('Date');
// Community article : List
// Vars : $communityArticlePager

echo _open('div.community_article.list');

 echo $communityArticlePager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($communityArticlePager as $communityArticle)
  {
    echo _open('li.element.mb10.clickable');
    
      echo _link($communityArticle->href)->text($communityArticle.'['.$communityArticle->language.']')->set('.block').
_tag('span.quiet', $communityArticle->author.' - '.format_date($communityArticle->createdAt, 'D'));
      
    echo £c('li');
  }

  echo £c('ul');

 echo $communityArticlePager->renderNavigationBottom();

echo £c('div');