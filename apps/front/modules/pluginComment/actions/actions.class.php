<?php
/**
 * Plugin comment actions
 * 
 */
class pluginCommentActions extends myFrontModuleActions
{

  public function executeFormWidget(dmWebRequest $request)
  {
    $form = new PluginCommentForm();
        
    if ($request->isMethod('post') && $form->bindAndValid($request))
    {
      $form->save();
      $this->redirectBack();
    }

    $this->forms['PluginComment'] = $form;
  }


}
