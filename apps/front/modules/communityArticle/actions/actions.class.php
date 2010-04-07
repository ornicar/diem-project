<?php
/**
 * Community article actions
 * 
 */
class communityArticleActions extends myFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new CommunityArticleForm();
        
    if ($request->isMethod('post') && $form->bindAndValid($request))
    {
      $form->save();
      $this->redirectBack();
    }

    $this->forms['CommunityArticle'] = $form;
  }


}
