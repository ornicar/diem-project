<?php
/*
 * Action for Documentation page : Show
 * Vars : $docPage
 */

echo _open('div.doc_page.show');

  echo _tag('h1.t_big', $docPage);

  echo _tag('h2.t_baseline', $docPage->resume);

  echo markdown($docPage->text);
  
  if  (!$docPage->isDone)
  {
    echo _tag('p.t_medium', __('Work in progress')).
    _tag('p.mt20', __('This documentation page is not complete yet. We are working hard to make it available as soon as possible.'));
  }
  
  echo _tag('div.chapter_feedback',
    _tag('p.t_medium', 'Questions and Feedback').
    _tag('p',
      'If you need support or have a technical question, you can').
    _tag('div.markdown', _tag('ul',
      _tag('li', 'Get help with the '._link('http://groups.google.com/group/diem-users')->text('Google Group')).
      _tag('li', 'Get help with the '._link('http://forum.diem-project.org/')->text(__('Forum'))).
      _tag('li', 'Come and chat on the #diem IRC channel on freenode')
    ))
  );
  
  echo _tag('div.chapter_nav.clearfix',
  
    ($previous ? _link($previous)->set('.previous') : '').
    
    _link('#dm_page')->text(__('Back to top')).
    
    ($next ? _link($next)->set('.next') : '')
    
  );
  
echo _close('div');

echo _tag('hr').markdown('The documentation is [hosted on GitHub](http://github.com/diem-project/diem-docs/tree/'.$docPage->Doc->Branch->number.' "Diem documentation on GitHub"). Feel free to submit issues and patches!');