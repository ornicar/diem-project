<?php

class DocPageTable extends myDoctrineTable
{
  public function getAdminListQuery(dmDoctrineQuery $query)
  {
    return parent::getAdminListQuery($query)
    ->leftJoin('doc.Branch branch');
  }
}
