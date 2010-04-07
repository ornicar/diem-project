<?php

class AnonymousReportTable extends myDoctrineTable
{

  public function register($hash, $plugins, $version)
  {
    if(strlen($hash) != 32)
    {
      throw new dmException('Bad hash');
    }
    
    if(!$report = $this->findOneByHash($hash))
    {
      $report = $this->create(array(
        'hash' => $hash
      ));
    }

    $report->set('diem_version', $version);

    $report->save();

    $refTable = dmDb::table('AnonymousReportPlugin');

    $refTable->createQuery('arp')
    ->delete()
    ->where('arp.anonymous_report_id = ?', $report->get('id'))
    ->execute();

    $pluginNames = array_map('trim', explode(',', $plugins));

    if(!empty($pluginNames))
    {
      $plugins = dmDb::query('Plugin p')
      ->select('p.name, p.id')
      ->whereIn('p.name', $pluginNames)
      ->fetchArray();

      $refs = new Doctrine_Collection($refTable);

      foreach($plugins as $plugin)
      {
        $refs->add($refTable->create(array(
          'anonymous_report_id' => $report->get('id'),
          'plugin_id' => $plugin['id']
        )));
      }

      $refs->save();
    }
  }

  public function findOneByHash($hash)
  {
    return $this->createQuery('r')->where('r.hash = ?', $hash)->fetchRecord();
  }
}
