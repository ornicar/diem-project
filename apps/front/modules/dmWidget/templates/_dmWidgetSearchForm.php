<?php

echo
$form->open('.clearfix action=main/search method=get'),

$form['query']->field('.search_field'),

$form->close();