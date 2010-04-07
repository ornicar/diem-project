<?php use_helper('Date');
// Community article : List
// Vars : $communityArticlePager

echo £o('div.community_article.list');

 echo $communityArticlePager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($communityArticlePager as $communityArticle)
  {
    echo £o('li.element.mb10.clickable');
    
      echo £link($communityArticle->href)->text($communityArticle.'['.$communityArticle->language.']')->set('.block').
£('span.quiet', $communityArticle->author.' - '.format_date($communityArticle->createdAt, 'D'));
      
    echo £c('li');
  }

  echo £c('ul');

 echo $communityArticlePager->renderNavigationBottom();

echo £c('div');