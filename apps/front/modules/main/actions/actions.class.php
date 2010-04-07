<?php
/**
 * Main actions
 */
class mainActions extends dmFrontModuleActions
{

  public function executeReportAnonymousData(dmWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    try
    {
      dmDb::table('AnonymousReport')->register(
        $request->getParameter('hash'),
        $request->getParameter('plugins'),
        $request->getParameter('version')
      );
    }
    catch(Exception $e)
    {
      throw $e;
      $this->forward404();
    }

    return $this->renderText('ok');
  }

  public function executeCurrentVersion(dmWebRequest $request)
  {
    if($branch = $request->getParameter('branch'))
    {
      $version = dmDb::pdo(
        'SELECT v.number FROM version v INNER JOIN branch b ON v.branch_id = b.id AND b.number = ? WHERE v.is_active = ? ORDER BY v.position ASC LIMIT 1',
        array(str_replace(array('_', '-'), '.', $branch), true)
      )
      ->fetchColumn();
    }
    else
    {
      $version = dmDb::pdo(
        'SELECT v.number FROM version v WHERE v.is_active = ? ORDER BY v.position ASC LIMIT 1',
        array(true)
      )
      ->fetchColumn();
    }

    return $this->renderText($version);
  }

}
