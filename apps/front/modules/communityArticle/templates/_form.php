<?php
// Community article : Form
// Vars : $form

echo

_tag('a.toggler', __('Submit an article')).

$form->open('anchor=true').

_tag('ul',

  _tag('li', $form['href']->label(__('Url'))->field()).

  _tag('li', $form['title']->label()->field()).

  _tag('li', $form['author']->label()->field()).

  _tag('li', $form['language']->label()->field())

).

$form->renderHiddenFields().

$form->submit(__('Submit an article')).

$form->close();