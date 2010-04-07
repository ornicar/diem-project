<?php use_helper('Date');
/*
 * Action for Comment : List by post
 * Vars : $pluginCommentPager
 */

echo _open('div.comment.list_by_plugin');

 echo $pluginCommentPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($pluginCommentPager as $pluginComment)
  {
    echo _open('li.element');
    
      echo _tag('p.author',
        _tag('strong.mr10', $pluginComment->name ? escape($pluginComment->name) : escape('<anonymous>')).
        _tag('span.quiet', format_datetime($pluginComment->createdAt, 'f'))
      );
      
      echo _tag('p', nl2br(escape($pluginComment->text)));
      
    echo _close('li');
  }

  echo _close('ul');

 echo $pluginCommentPager->renderNavigationBottom();

echo _close('div');