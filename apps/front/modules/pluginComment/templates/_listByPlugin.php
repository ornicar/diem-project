<?php use_helper('Date');
/*
 * Action for Comment : List by post
 * Vars : $pluginCommentPager
 */

echo £o('div.comment.list_by_plugin');

 echo $pluginCommentPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($pluginCommentPager as $pluginComment)
  {
    echo £o('li.element');
    
      echo _tag('p.author',
        _tag('strong.mr10', $pluginComment->name ? escape($pluginComment->name) : escape('<anonymous>')).
        _tag('span.quiet', format_datetime($pluginComment->createdAt, 'f'))
      );
      
      echo _tag('p', nl2br(escape($pluginComment->text)));
      
    echo £c('li');
  }

  echo £c('ul');

 echo $pluginCommentPager->renderNavigationBottom();

echo £c('div');