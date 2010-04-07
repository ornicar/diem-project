<?php
/**
 * Plugin actions
 * 
 */
class pluginActions extends myFrontModuleActions
{

  public function executeFormCreateWidget(dmWebRequest $request)
  {
    $form = new PluginForm();
        
    if ($request->isMethod('post') && $form->bindAndValid($request))
    {
      $plugin = $form->updateObject();

      $plugin->isActive = true;

      $plugin->save();
      
      $this->redirect($this->getHelper()->link($plugin)->getHref());
    }

    $this->forms['Plugin'] = $form;
  }

  public function executeFormEditWidget(dmWebRequest $request)
  {
    $plugin = dmDb::query('Plugin p')
    ->leftJoin('p.CreatedBy user')
    ->where('user.id = ?', $this->getUser()->getUserId())
    ->where('p.name = ?', $request->getParameter('name'))
    ->fetchOne();
      
    $this->forward404Unless($plugin);

    $form = new PluginForm($plugin);

    unset($form['name']);
        
    if ($request->isMethod('post') && $form->bindAndValid($request))
    {
      $form->save();

      $this->redirect($this->getHelper()->link($plugin)->getHref());
    }

    $this->forms['Plugin'] = $form;
  }

  public function executeDelete(dmWebRequest $request)
  {
    $plugin = dmDb::query('Plugin p')
    ->leftJoin('p.CreatedBy user')
    ->where('user.id = ?', $this->getUser()->getUserId())
    ->where('p.name = ?', $request->getParameter('name'))
    ->fetchOne();

    $this->forward404Unless($plugin);

    $plugin->isActive = false;
    $plugin->save();

    $this->redirect($this->getHelper()->link('plugin/list')->getHref());
  }

  public function executeRss(dmWebRequest $request)
  {
    $records = dmDb::query('Plugin p')
    ->leftJoin('p.CreatedBy user')
    ->where('p.is_active = ?', true)
    ->orderBy('p.position ASC')
    ->limit(20)
    ->fetchRecords();
    $this->preloadPages($records);
    $feed = new sfRssFeed();
    $feed->setTitle('Diem Project Plugins');
    $feed->setLink('http://diem-project.org/plugins');
    $feed->setAuthorName('Thibault Duplessis');
    foreach ($records as $record)
    {
      $item = new sfFeedItem();
      $item->setTitle($record->name);
      $item->setLink($this->getHelper()->link($record)->getAbsoluteHref());
      $item->setAuthorName($record->CreatedBy);
      $item->setPubdate($record->getDateTimeObject('created_at')->format('U'));
      $item->setUniqueId($record->name.' ('.$record->id.')');

      $item->setDescription(
        $this->getService('markdown')->toHtml($record->text)
      );
      $feed->addItem($item);
    }
    $this->feed = $feed;
  }

  public function executeShowWidget(dmWebRequest $request)
  {
    $form = new PluginCommentForm();

    if ($request->isMethod('post') && $data = $request->getParameter($form->getName()))
    {
      if($form->isCaptchaEnabled())
      {
        $data = array_merge($data, array('captcha' => array(
          'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
          'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        )));
      }

      $form->bind($data);

      if ($form->isValid())
      {
        $form->save();

        $this->getUser()->setFlash('form_saved', true);

        $this->redirectBack();
      }
    }

    $this->forms['PluginComment'] = $form;
  }

}
