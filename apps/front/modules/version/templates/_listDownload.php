<?php

echo _tag('div.box.fleft style="width: 300px"',
  _tag('h2.box_title', 'Diem on GitHub').
  _tag('div.box_inner',
    _tag('p', 'All source code is kept under Git control.').
    _tag('ul.box_list',
      _tag('li', _link('http://github.com/diem-project/diem')->text('Browse source')).
      _tag('li', _link('http://github.com/diem-project/diem/tarball/master')->text('Download source')).
      _tag('li', _link('#')->set('.toggle_clone_commands')->text('Clone the repository'))
    ).
    _tag('div.clone_commands', '<pre>git clone git://github.com/diem-project/diem.git
cd diem
git submodule init
git submodule update</pre>')
  )
);

echo _open('div style="margin-left: 340px"');

foreach ($versionPager as $version)
{
  echo _open('div.box#'.$version->Branch->anchor);

    echo _tag('h2.box_title',
      $version->name.
      _tag('span.featured', 'featured')
    );

    echo _open('div.box_inner');

      echo _tag('h3.t_version_baseline', $version->resume);

      echo _open('div.version_links');

        echo _tag('p.package',
          _link($version->downloadUrl)
          ->text(_tag('span.download_link', __('Download TGZ')))
          ->set('.button.green.large')
        );

        echo _tag('p.changelog',
          _link($version)->text(_tag('span', __('What\'s new', array(
          '%1%' => $version->name
          ))))->set('.button.large.blue')
        );

      echo _close('div');
      
    echo _close('div');

  echo _close('div');
}

echo _close('div');