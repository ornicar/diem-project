<?php
/**
 * Snippet actions
 * 
 * 
 * 
 */
class snippetActions extends myFrontModuleActions
{

  public function executeRss(dmWebRequest $request)
  {
    $records = dmDb::query('Snippet s')
    ->where('s.is_active = ?', true)
    ->orderBy('s.position ASC')
    ->limit(20)
    ->fetchRecords();

    $this->preloadPages($records);

    $feed = new sfRssFeed();

    $feed->setTitle('Diem Project Snippets');
    $feed->setLink('http://diem-project.org/snippets');
    $feed->setAuthorName('Thibault Duplessis');

    foreach ($records as $record)
    {
      $item = new sfFeedItem();
      $item->setTitle($record->name);
      $item->setLink($this->getHelper()->£link($record)->getAbsoluteHref());
      $item->setAuthorName($record->createdBy);
      $item->setPubdate($record->getDateTimeObject('created_at')->format('U'));
      $item->setUniqueId($record->name.' ('.$record->id.')');
      
      $item->setDescription(
        $record->getMarkdownText($this->context->get('markdown'))
      );

      $feed->addItem($item);
    }

    $this->feed = $feed;
  }
  
  public function executeMarkdown(dmWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));
    
    $text = $request->getParameter('text');
    
    return $this->renderText($this->context->get('markdown')->toHtml(dmString::escape($text, ENT_NOQUOTES)));
  }

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new SnippetForm();
    
    if ($request->isMethod('post'))
    {
      if($request->getParameter('recaptcha_challenge_field'))
      {
        $captcha = array(
          'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
          'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        );

        $form->bind(array_merge($request->getParameter($form->getName()), array('captcha' => $captcha)));
      }
      else
      {
        $form->bind($request->getParameter($form->getName()));
      }
      
      if ($form->isValid())
      {
        $form->save();
        
        $this->getUser()->setFlash('form_saved', true);
        
        return $this->redirect($this->getSnippetUrl($form->getObject()));
      }
    }

    $this->forms['Snippet'] = $form;
  }

  public function executeFormEditWidget(dmWebRequest $request)
  {
    $this->forward404Unless(
      $hash = $request->getParameter('hash')
    );
    $this->forward404Unless(
      $snippet = dmDb::table('Snippet')->findOneByHash($hash)
    );
    
    $form = $this->forms['Snippet'] = new SnippetForm($snippet);

    if ($request->isMethod('post'))
    {
      if($request->getParameter('recaptcha_challenge_field'))
      {
        $captcha = array(
          'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
          'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
        );

        $form->bind(array_merge($request->getParameter($form->getName()), array('captcha' => $captcha)));
      }
      else
      {
        $form->bind($request->getParameter($form->getName()));
      }

      if ($form->isValid())
      {
        $form->save();

        $this->getUser()->setFlash('form_saved', true);

        return $this->redirect($this->getSnippetUrl($form->getObject()));
      }
    }
  }

  protected function getSnippetUrl(Snippet $snippet)
  {
    return $this->getHelper()
    ->£link('snippet/modifyYourSnippet')
    ->param('hash', $snippet->hash)
    ->getHref();
  }

}
