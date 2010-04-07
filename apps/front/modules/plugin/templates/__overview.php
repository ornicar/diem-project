<?php use_helper('Date');

  echo _tag('ul.links.clearfix',
    ($plugin->githubUrl
    ? (_tag('li', _link($plugin->githubUrl)->text('View on github')->set('.button.blue.large')).
    _tag('li', _link($plugin->githubUrl.'/tarball/master')->set('.button.yellow.large')->text('Download TAR')).
    _tag('li', _link($plugin->githubUrl.'/zipball/master')->set('.button.yellow.large')->text('Download ZIP')))
    : (_tag('li', _link($plugin->symfonyUrl)
      ->text('View on symfony plugins repository')
      ->set('.button')
    ).
    _tag('li', _link($plugin->svnUrl)
      ->text('Download with SVN')
      ->set('.button')
    ))).
    ($plugin->packageUrl
    ? _tag('li', _link($plugin->packageUrl)
      ->text('Download package')
      ->set('.button')
      )
    : '').
    ((!$plugin->packageUrl && $plugin->Package->exists())
    ? _tag('li', _link($plugin->Package)
      ->text('Download package')
      ->set('.button')
      )
    : '').
    ($sf_user->ownsPlugin($plugin)
    ? _tag('li', _link('@plugin_edit')->param('name', $plugin->name)
      ->text('Modify')
      ->set('.button.large.green')
      )
    : '')
  );

  echo _tag('div.mt20', markdown($plugin->text));

  echo _tag('h2#installation.t_medium', __('Installation'));

  $installCommands = $plugin->githubUrl
  ? 'git clone '.$plugin->githubCloneUrl.' plugins/%plugin_name%'
  : 'svn co '.$plugin->svnUrl.' plugins/%plugin_name%';

  echo markdown(str_replace('%plugin_name%', $plugin->name,
($plugin->bundledInCore ? '' : '- In a console, from your project root dir, run:
[code]
'.$installCommands.'
[/code]
'."\n").
'- In **config/ProjectConfiguration.class.php**, add %plugin_name% to the list of enabled plugins:
[code php]
class ProjectConfiguration extends dmProjectConfiguration
{
  public function setup()
  {
    parent::setup();

    $this->enablePlugins(array(
      // your enabled plugins
      \'%plugin_name%\'
    ));
[/code]
- In a console, from your project root dir, run:'));

  if($plugin->requiresMigration)
  {
    echo markdown('
~~~
php symfony doctrine:generate-migrations-diff

php symfony doctrine:migrate

php symfony dm:setup
~~~');

  }
  else
  {
    echo markdown('
~~~
php symfony dm:setup
~~~');
  }