<?php // Vars: $form


echo

$form->open().

_tag('ul.dm_form_elements',

  $form->getFormFieldSchema()->render().

  _tag('li.dm_form_element', $form->renderSubmitTag(__('Create the plugin')))

).

$form->renderHiddenFields().

$form->close();