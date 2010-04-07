<?php use_helper('Text', 'Date');

/*
 * A $commit is an array containing: http://develop.github.com/p/commits.html#listing_commits_on_a_branch
 */

echo _open('ul');

foreach($commits as $commit)
{
  echo _tag('li.clickable',

    _link($commit['url'])
    ->text(auto_link_text(escape($commit['message'])))
    ->set('.block').
    _tag('span.quiet.little',
      format_date($commit['committed_date'], 'd/MM H:mm').
      ' by '.
      escape($commit['author']['name'])
    )
  
  );
}

echo _close('ul');