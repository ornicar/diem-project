<?php

require_once sfConfig::get('dm_core_dir').'/plugins/dmUserPlugin/modules/dmUser/lib/BasedmUserActions.class.php';

class dmUserActions extends BasedmUserActions
{

  public function redirectRegisteredUser(dmWebRequest $request)
  {
    $this->redirect($this->getHelper()->link('plugin/list')->getHref());
  }

  protected function redirectSignedInUser(dmWebRequest $request)
  {
    $redirectUrl = $this->getUser()->getReferer($request->getReferer());

    // add ?_=1 to avoid browser cache >:l
    $this->redirect('' != $redirectUrl ? $redirectUrl.'?_=1' : '@homepage');
  }
}