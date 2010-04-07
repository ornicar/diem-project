<?php

try
{
  include_partial('dmWidget/dmWidgetGithubListCommits', array(
    'user'    => $plugin->githubUsername,
    'repo'    => $plugin->githubRepo,
    'commits' => $plugin->githubCommits
  ));
}
catch(phpGitHubApiRequestException $e)
{
  echo 'Impossible to get this plugin changelog.';
}

echo _tag('div.text_align_center.mt5',
  _link($plugin->githubUrl.'/commits')->text('See more commits')->set('.button.blue.large')
);