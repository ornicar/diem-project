<?php
// Snippet : Edit url


echo £('div.snippet_edit_help',
  'With this url, you can modify your snippet. Keep it preciously:<br />'.
  £link($sf_request->getUri())
  ->text($sf_request->getUri())
);