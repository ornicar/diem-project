<?php

echo _link('main/download')
->set('.button.large.blue.download')
->text(_tag('span', __('Download')));

echo _link($demo)
->set('.button.large.orange.demo')
->text(_tag('span', __('Try online')));

echo _link('tour/index')
->set('.button.large.green.features')
->text(_tag('span', __('Take the tour')));