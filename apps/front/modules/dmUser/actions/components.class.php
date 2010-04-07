<?php

require_once sfConfig::get('dm_core_dir').'/plugins/dmUserPlugin/modules/dmUser/lib/BasedmUserComponents.class.php';

class dmUserComponents extends BasedmUserComponents
{

  public function executeMyAccount()
  {
    if($this->user = $this->getUser()->getDmUser())
    {
      $this->plugins = dmDb::query('Plugin p')
      ->where('p.created_by = ?', $this->user->id)
      ->andWhere('p.is_active = ?', true)
      ->orderByPosition()
      ->fetchRecords();

      $this->preloadPages($this->plugins);
    }
    else
    {
      $this->form = $this->forms['DmSigninFront'] = new DmSigninFrontForm();
      unset($this->form['remember_me']);
    }
  }
}