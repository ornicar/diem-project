<?php use_helper('Date');
// Snippet comment : List by snippet
// Vars : $snippetCommentPager

echo £o('div.comment.list_by_snippet');

 echo $snippetCommentPager->renderNavigationTop();

  echo £o('ul.elements');

  foreach ($snippetCommentPager as $snippetComment)
  {
    echo £o('li.element');
    
      echo _tag('p.author',
        _tag('strong.mr10', $snippetComment->name ? escape($snippetComment->name) : escape('<anonymous>')).
        _tag('span.quiet', format_datetime($snippetComment->createdAt, 'f'))
      );
      
      echo _tag('p', nl2br(escape($snippetComment->text)));
      
    echo £c('li');
  }

  echo £c('ul');

 echo $snippetCommentPager->renderNavigationBottom();

echo £c('div');