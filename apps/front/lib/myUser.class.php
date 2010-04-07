<?php

class myUser extends dmFrontUser
{

  public function ownsPlugin(Plugin $plugin)
  {
    return $this->isAuthenticated() && $this->getUserId() == $plugin->get('created_by');
  }
}