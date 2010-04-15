<?php use_helper('Date');

echo _tag('h1.t_big', $branch->name);
echo _tag('h2.t_baseline', $branch->resume);

echo _open('div.fleft style="width:260px;"');

echo _tag('div.box',

  _tag('h2.box_title', 'A CMS/CMF for symfony').

  _tag('div.box_inner',
    _link('tour/index')->text(_tag('strong', __('Take the Diem tour'))).
    _tag('ul.box_list',
      _tag('li', _link('tour/features')).
      _tag('li', _link('tour/sitesUsingDiem')).
      _tag('li', _link('tour/about')).
      _tag('li', _link('tour/license'))
    )
  )
);

$howToDescription = 'This section contains precise showcases, with concrete examples.<br />'.
_link($openSourceProjects)->text('Get this website source code').' and study it!';

echo _tag('div.box',

  _tag('h2.box_title', 'How to...').

  _tag('div.box_inner',
    _link($howTo)->text(_tag('strong', __('Get contextual help'))).
     _tag('p.mt10', $howToDescription)
  )
);

echo _close('div');

echo _open('div style="margin-left:280px;"');

$tutoDescription = <<<EOF
This step by step tutorial is the best way to get started.<br />
You will learn how to build a full-featured website in few time, step by step.<br />
EOF;

echo _tag('div.box',

  _tag('h2.box_title', 'A fun, easy and complete tutorial').

  _tag('div.box_inner',
    _link($tuto)->text(_tag('strong', __('Start learning Diem right now'))).
     _tag('p.mt10', $tutoDescription)
  )
);

$bookDescription = <<<EOF
This is the main documentation for Diem.<br />
It covers all aspects of site creation, from the installation to the more advanced customization tips.<br />
Some symfony knowledge is recommended.<br />
EOF;

echo _tag('div.box',

  _tag('h2.box_title', 'Reference Book').

  _tag('div.box_inner',
    _link($tuto)->text(_tag('strong', __('Start reading the book'))).
     _tag('p.mt10', $bookDescription)
  )
);

echo _close('div');

echo _tag('div.clearfix');

echo markdown('The documentation is [hosted on GitHub](http://github.com/diem-project/diem-docs/tree/'.$branch->number.' "Diem documentation on GitHub"). Feel free to submit issues and patches!');

echo markdown($branch->whatsnew);