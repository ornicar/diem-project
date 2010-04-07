<?php use_helper('Text');

/*
 * An $issue is an array containing: http://develop.github.com/p/issues.html#list_a_projects_issues
 */

echo _open('ul');

foreach($issues as $issue)
{
  // link to the issue page on github
  if($state == 'open')
  {
    $issueLink = _link('http://github.com/'.$user.'/'.$repo.'/issues#issue/'.$issue['number']);
  }
  else
  {
    $issueLink = _link('http://github.com/'.$user.'/'.$repo.'/issues/'.$state.'#issue/'.$issue['number']);
  }
  $issueLink->text($issue['title'])
    ->set('.issue_title');
  
  echo _tag('li.clickable',

    $issueLink
    ->text(auto_link_text(escape($issue['title'])))
    ->set('.block').
    _tag('span.quiet.little',
      format_date($issue['created_at'], 'd/MM H:mm').
      ' by '.
      _link('http://github.com/'.$issue['user'])->text(escape($issue['user']))
    ).

    // render issue text
    _tag('p.issue_text', auto_link_text(escape($issue['body'])))
  
  );
}

echo _close('ul');