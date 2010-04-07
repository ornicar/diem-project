<?php use_helper('Date', 'Text');
/*
 * Action for Version : Show
 * Vars : $version
 */

echo £o('div.version.show');

  echo £('h1.t_big', $version->name);
  echo £('h2.t_baseline', $version->resume);

  if($version->githubTag)
  {
    echo £('p.mb10',
      _link($version->downloadUrl)
      ->text(_tag('span.download_link', __('Download '.$version.' in TGZ')))
      ->set('.button.large.orange')
    );
  }

  echo £('h2.t_medium', __('Version notes'));
  
  echo £('p.quiet.mb5', format_date($version->createdAt, 'D'));
  
  echo markdown($version->text);

  echo £('h2.t_medium', __('Changelog'));

  if($version->svnUrl)
  {
    echo £('p.mb10',
      £link('http://trac.symfony-project.org/log/plugins/diemPlugin/trunk')
      ->text(__('View the changelog on symfony trac'))
    );
  }
  elseif($version->githubTag)
  {
    echo £o('ul.commits');
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
    echo £c('ul');

    echo £('p.mt10', 'And many more... '.
      £link('http://github.com/diem-project/diem/commits/'.$version->githubTag)
      ->text(__('View more commits on github'))
    );
  }
  
  $markdown = markdown($version->changelog);
  
  if ($version->changelog && '<div class="markdown"></div>' == $markdown)
  {
    echo £('em', 'Sorry, the changelog is so big, the markdown parser can not transform it.');
    echo £('div.markdown.mt10', nl2br(dmString::escape($version->changelog)));
  }
  else
  {
    echo $markdown;
  }
  
echo £c('div');
