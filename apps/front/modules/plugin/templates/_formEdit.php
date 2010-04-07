<?php // Vars: $form

echo

_tag('h1.t_big', 'Modify '.$plugin->name).

_link($plugin)->text(escape(__('< Back to the plugin'))).

$form->open().

_tag('ul.dm_form_elements',

  $form->getFormFieldSchema()->render().

  _tag('li.dm_form_element', $form->renderSubmitTag(__('Update the plugin'), '.button.blue.large'))

).

$form->renderHiddenFields().

$form->close().

'<hr />'.

_link('@plugin_delete')
->param('name', $plugin->name)
->text(__('Delete this plugin'))
->set('.js_confirm');