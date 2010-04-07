<?php

echo _tag('nav',

  _link('main/download').

  _link($demo)->text(__('Demo')).

  _link('plugin/list').

  _link('tour/index').

  _link($doc)->text(__('Documentation')).

  _link('article/list').

  _link('main/community').

  _link('main/development')

);