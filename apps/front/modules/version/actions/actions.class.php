<?php
/**
 * Version actions
 */
class versionActions extends dmFrontModuleActions
{

  public function executeDownloadLatest(dmWebRequest $request)
  {
    $branch = $request->getParameter('branch');

    $version = dmDb::query('Version v')
    ->innerJoin('v.Branch b')
    ->where('b.number = ?', str_replace(array('_', '-'), '.', $branch))
    ->andWhere('v.is_active = ?', true)
    ->orderBy('v.position ASC')
    ->fetchOne();

    $this->redirect('http://github.com/downloads/diem-project/diem/diem-'.$version->number.'.tgz');
  }

  public function executeDownload(dmWebRequest $request)
  {
    $this->forward404Unless(
      $versionNumber = $request->getParameter('v')
    );
    
    $this->forward404Unless(
      $version = dmDb::table('Version')->findOneByNumber($versionNumber)
    );
    
    $this->forward404Unless($package = $version->Package);
    
    $this->forward404Unless($package->exists());
    
    $fileName = sprintf('diem-%s%s', $version->number, dmOs::getFileExtension($package->fullPath));

    $this->getService('event_log')->setOption('enabled', false);
    $version->mapValue('disable_versioning', true);
    $version->downloads = $version->downloads+1;
    $version->save();
    
    $this->context->getEventDispatcher()->notify(new sfEvent($this, 'download.package', array(
      'version' => $version->number
    )));
    
    return $this->download($package->fullPath, array('file_name' => $fileName));
  }
  
}
