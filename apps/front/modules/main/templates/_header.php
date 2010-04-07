<?php

echo £('nav',

  £link('main/download').

  £link($demo)->text(__('Demo')).

  £link('plugin/list').

  £link('tour/index').

  £link($doc)->text(__('Documentation')).

  £link('article/list').

  £link('main/community').

  £link('main/development')

);