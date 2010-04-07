<?php
/**
 * Plugin comment components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class pluginCommentComponents extends myFrontModuleComponents
{

  public function executeListByPlugin()
  {
    $query = $this->getListQuery();
    $this->pluginCommentPager = $this->getPager($query);
  }

  public function executeForm()
  {
    $this->form = $this->forms['PluginComment'];
  }


}
