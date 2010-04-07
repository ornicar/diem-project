<?php

require_once dirname(__FILE__).'/../lib/branchGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/branchGeneratorHelper.class.php';

/**
 * branch actions.
 *
 * @package    diemSite
 * @subpackage branch
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class branchActions extends autoBranchActions
{
  public function executeInit(dmWebRequest $request)
  {
    $this->forward404Unless($branch = dmDb::table('Branch')->findOneById($request->getParameter('pk')));
    $this->forward404Unless($fromBranch = dmDb::table('Branch')->findOneById($request->getParameter('from')));

    $branch->Docs->delete();

    foreach($fromBranch->Docs as $doc)
    {
      $newDoc = dmDb::table('Doc')->create(array(
        'branch_id' => $branch->id,
        'name'    => $doc->name,
        'type'    => $doc->type,
        'resume'  => $doc->resume,
        'is_active' => $doc->is_active
      ))->saveGet();

      $newDoc->position = $doc->position+1000;
      $newDoc->save();

      foreach($doc->Pages as $docPage)
      {
        $newDocPage = dmDb::table('DocPage')->create(array(
          'doc_id' => $newDoc->id,
          'name'    => $docPage->name,
          'resume'  => $docPage->resume,
          'is_active' => $docPage->is_active,
          'is_done' => $docPage->is_done,
          'position' => $docPage->position+1000
        ))->saveGet();

        $newDocPage->position = $docPage->position+1000;

        $newDocPage->setTags($docPage->getTagsString())->save();
      }
    }

    $this->redirectBack();
  }
}