<?php
// Community article : Form
// Vars : $form

echo

£('a.toggler', __('Submit an article')).

$form->open('anchor=true').

£('ul',

  £('li', $form['href']->label(__('Url'))->field()).

  £('li', $form['title']->label()->field()).

  £('li', $form['author']->label()->field()).

  £('li', $form['language']->label()->field())

).

$form->renderHiddenFields().

$form->submit(__('Submit an article')).

$form->close();