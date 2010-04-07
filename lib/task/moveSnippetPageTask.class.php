<?php

class moveSnippetPageTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    parent::configure();
    
    $this->namespace = 'my';
    $this->name = 'move-snippet-page';
    $this->briefDescription = '-';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->withDatabase();
    
    $snippetPage = dmDb::table('DmPage')->findOneByModuleAndAction('snippet', 'list');

    if($snippetPage->Node->getParent()->isModuleAction('main', 'root'))
    {
      $communityPage = dmDb::table('DmPage')->findOneByModuleAndAction('main', 'community');

      $snippetPage->Node->moveAsFirstChildOf($communityPage);
    }
  }
}