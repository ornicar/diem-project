<?php

echo _tag('div.text_align_center.mb10',
  _link($plugin->githubUrl.'/issues')->text('Create an issue')->set('.button.blue.large')
);

echo _open('div.clearfix');

foreach(array('open', 'closed') as $state)
{
  try
  {
    $gitHubIssues = get_partial('dmWidget/dmWidgetGithubListIssues', array(
      'issues'  => $plugin->getGithubIssues($state),
      'user'    => $plugin->githubUsername,
      'repo'    => $plugin->githubRepo,
      'state'   => $state
    ));
  }
  catch(phpGitHubApiRequestException $e)
  {
    echo _close('div').'Impossible to fetch issues for this plugin.';
    return;
  }

  echo _tag('div.issues_list.issues_'.$state,

    _tag('p.t_medium', ucfirst($state).' issues').
    $gitHubIssues
  );
}

echo _close('div');