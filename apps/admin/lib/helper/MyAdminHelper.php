<?php

function createdAtBy(Doctrine_Record $record)
{
  $user = $record->get('CreatedBy');
  if($user && $user->isNew())
  {
    $user = null;
  }
  return format_date($record->get('created_at'), 'f').($user ? ' - '.$user->get('username') : '');
}

function updatedAtBy(Doctrine_Record $record)
{
  $user = $record->get('UpdatedBy');
  if($user && $user->isNew())
  {
    $user = null;
  }
  return format_date($record->get('updated_at'), 'f').($user ? ' - '.$user : '');
}