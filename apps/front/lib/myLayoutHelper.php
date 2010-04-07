<?php

class myLayoutHelper extends dmFrontLayoutHelper
{
  public function renderHead()
  {
    return parent::renderHead().$this->renderRssLinks();
  }
  
  public function renderRssLinks()
  {
    return
    sprintf('<link rel="alternate" type="application/rss+xml" title="Diem Blog" href="%s" />',
      $this->getHelper()->link('@blog_rss')->getHref()
    ).
    sprintf('<link rel="alternate" type="application/rss+xml" title="Diem Plugins" href="%s" />',
      $this->getHelper()->link('@plugin_rss')->getHref()
    ).
    sprintf('<link rel="alternate" type="application/rss+xml" title="Diem Snippets" href="%s" />',
      $this->getHelper()->link('@snippet_rss')->getHref()
    );
  }
}