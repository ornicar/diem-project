<?php
/**
 * Main components
 * 
 */
class mainComponents extends dmFrontModuleComponents
{

  public function executeHeader()
  {
    $this->doc = $this->getDoc();
    $this->demo = dmDb::table('Article')->findOneByName('Online demo available');
  }

  public function executeFooter()
  {
    $this->demo = dmDb::table('Article')->findOneByName('Online demo available');
    $this->doc = $this->getDoc();
  }

  protected function getDoc()
  {
    return dmDb::table('Branch')->findOneByNumber('5.0');
  }

  public function executeHomeLinks()
  {
    $this->demo = dmDb::table('Article')->findOneByName('Online demo available');
  }

  public function executeSitemap()
  {
    $this->menu = $this->context->get('sitemap_menu')->build();
  }

  public function executeTest()
  {
    $widget = dmDb::query('DmWidget q')->withI18n()->where('q.id = ?', 272)->fetchOne();

    $widgetValue = $widget->value;
    $widget = $widget->toArray();
    $widget['value'] = $widgetValue;

    $this->html = $this->getService('page_helper')->renderWidget($widget);
  }


}
