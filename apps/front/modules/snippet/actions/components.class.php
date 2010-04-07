<?php

class snippetComponents extends myFrontModuleComponents
{

  public function executeList()
  {
    $query = $this->getListQuery();
    $this->snippetPager = $this->getPager($query);
  }

  public function executeListLittle()
  {
    $query = $this->getListQuery();
    $this->snippetPager = $this->getPager($query);
  }

  public function executeListMenu()
  {
    $query = $this->getListQuery();
    $this->snippetPager = $this->getPager($query);
  }

  public function executeShow()
  {
    $query = $this->getShowQuery();
    $this->snippet = $this->getRecord($query);
    
    $this->snippetHtml = $this->snippet->getMarkdownText($this->context->get('markdown'));
  }

  public function executeForm()
  {
    $this->form = $this->forms['Snippet'];
  }

  public function executePreviz()
  {
    
  }

  public function executeFormEdit()
  {
    $this->form = $this->forms['Snippet'];
  }

  public function executeEditUrl()
  {
    // Your code here
  }

  public function executeTitle()
  {
    // Your code here
  }


}
