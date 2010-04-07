<?php

echo _tag('div.clearfix',

  _tag('div.navigation.clearfix',

    _tag('nav.footer_menu style="width: 27%"',
      _link('main/download')->currentSpan(false).
      _link($demo)->text(__('Demo'))->currentSpan(false).
      _link('plugin/list')->currentSpan(false).
      _link('tour/index')->currentSpan(false)
    ).
    _tag('nav.footer_menu style="width: 27%"',
      _link($doc)->text(__('Documentation'))->currentSpan(false).
      _link('article/list')->currentSpan(false).
      _link('main/community')->text(__('Community'))->currentSpan(false).
      _link('main/development')->text(__('Development'))->currentSpan(false)
    ).
    _tag('nav.footer_menu style="width: 39%"',
      _link('http://forum.diem-project.org/')->text(__('Forum')).
      _link('http://groups.google.com/group/diem-users')->text(__('Google Group')).
      _link('http://github.com/diem-project/diem')->text(__('View on GitHub')).
      _link('http://ci.diem-project.org')->text(__('Continuous integration'))
    )
  ).

  _tag('div.community',

    _tag('nav',
      _link('http://twitter.com/diem_project')->text(
        _media('twitter.png')->size(24, 24).
        __('Follow on twitter')
      ).'<br />'.
      _link('@blog_rss')->text(
        _media('rss24.png')->size(24, 24).
        __('Blog feed')
      ).'<br />'.
      _link('@plugin_rss')->text(
        _media('rss24.png')->size(24, 24).
        __('Plugins feed')
      )
    )
  ).

  _link('http://www.opensource.org/docs/definition.php')
  ->text(_media('opensource.png')->size(80, 80)->alt('Diem is proud to be Open Source'))
  ->set('.opensourcelink').

  _tag('div.more_links', _tag('nav.more_links_inner',
    _tag('p', 'The Diem project.<br />Powered by Diem '.DIEM_VERSION).
    _link('tour/license')->currentSpan(false).' | '.
    _link('tour/about')->currentSpan(false).' | '.
    _link('main/contact')->currentSpan(false)->text(__('Contact')).' | '.
    _link('main/sitemap')->currentSpan(false).
    _tag('p', 'Thibault Duplessis').
    _link('http://validator.w3.org/check?uri=referer')
    ->text(_media('w3c-html5.png'))
    ->title('Site valid HTML 5').
    _link('http://diem-project.org/')
    ->text(_media('logo24s.png')->set('.ml5'))
    ->title('Diem CMS/CMF for symfony').
    _link('http://en.wikipedia.org/wiki/Open_source_software')
    ->text(_media('bio-software.png')->set('.ml5'))
    ->title('Biological site done with open source software')
  ))
);