<?php
/**
 * Documentation page actions
 */
class docPageActions extends dmFrontModuleActions
{
  public function executeUpdateFromGit(dmWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $localRepo = sfConfig::get('sf_root_dir').'/data/diem-docs';

    exec('cd "'.$localRepo.'" && git pull origin master'."\n", $result, $returnCode);

    if(0 != $returnCode)
    {
      throw new dmException('git pull origin master returns '.$returnCode.': '.implode("\n", $result));
    }

    $versions = dmDb::query('Branch b')
    ->select('b.number')
    ->fetchFlat();

    $types = dmDb::query('Doc d')
    ->select('d.type')
    ->distinct()
    ->fetchFlat();

    $cultures = sfConfig::get('dm_i18n_cultures');

    foreach($versions as $version)
    {
      foreach($types as $type)
      {
        foreach($cultures as $culture)
        {
          $this->getUser()->setCulture($culture);

          $dir = dmOs::join($localRepo, $version, $type, $culture);
          $files = sfFinder::type('file')->name('/^\d{2}\s-\s.+\.markdown$/')->in($dir);

          foreach($files as $file)
          {
            $docName = preg_replace('/^\d{2}\s-\s(.+)\.markdown$/', '$1', basename($file));

            $docRecord = dmDb::query('DocPage dp')
            ->withI18n()
            ->innerJoin('dp.Doc doc')
            ->innerJoin('doc.Branch branch')
            ->where('branch.number = ?', $version)
            ->andWhere('doc.type = ?', $type)
            ->andWhere('dpTranslation.name = ?', $docName)
            ->fetchOne();

            if($docRecord)
            {
              $docText = file_get_contents($file);

              if($docRecord->text != $docText)
              {
                echo 'Update '.$docName.'<br />';
                $docRecord->text = $docText;
                $docRecord->save();
              }
            }
          }
        }
      }
    }

    $this->getService('page_tree_watcher')->update();

    return $this->renderText('----<br />done');
  }

}
