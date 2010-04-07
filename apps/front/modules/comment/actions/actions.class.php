<?php
/**
 * Comment actions
 */
class commentActions extends dmFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new CommentForm();
    
    if ($request->isMethod('post'))
    {
      $captcha = array(
        'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
        'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
      );
      
      $form->bind(array_merge($request->getParameter($form->getName()), array('captcha' => $captcha)));
      
      if ($form->isValid())
      {
        $form->save();
        
        $this->getUser()->setFlash('form_saved', true);
        
        $this->redirectBack();
      }
    }

    $this->forms['Comment'] = $form;
  }


}
