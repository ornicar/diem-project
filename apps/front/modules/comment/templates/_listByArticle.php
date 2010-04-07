<?php use_helper('Date');
/*
 * Action for Comment : List by post
 * Vars : $commentPager
 */

echo _open('div.comment.list_by_article');

 echo $commentPager->renderNavigationTop();

  echo _open('ul.elements');

  foreach ($commentPager as $comment)
  {
    echo _open('li.element');
    
      echo _tag('p.author',
        _tag('strong.mr10', $comment->name ? escape($comment->name) : escape('<anonymous>')).
        _tag('span.quiet', format_datetime($comment->createdAt, 'f'))
      );
      
      echo _tag('p', nl2br(escape($comment->text)));
      
    echo _close('li');
  }

  echo _close('ul');

 echo $commentPager->renderNavigationBottom();

echo _close('div');