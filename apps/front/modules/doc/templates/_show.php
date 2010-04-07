<?php
/*
 * Action for Documentation : Show
 * Vars : $doc
 */

echo _open('div.doc.show');

  echo _tag('h1.t_big', $doc->name);
  
  echo markdown($doc->text);
  
echo £c('div');
