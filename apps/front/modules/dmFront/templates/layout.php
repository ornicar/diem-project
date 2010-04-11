<?php
/** @var dmFrontLayoutHelper */
$helper = $sf_context->get('layout_helper');

echo 
$helper->renderDoctype(),
$helper->renderHtmlTag(),

  "\n<head>\n",
    $helper->renderHead(),
  "\n</head>\n",
  
  $helper->renderBodyTag(),
  
    $sf_content,

    _link('http://github.com/diem-project/diem')->text(
      _media('fork_me_right.png')->alt('Fork Diem on GitHub')->set('#fork_me_right')
    ).
    
    $helper->renderEditBars(),
    
    $helper->renderJavascriptConfig(),
    $helper->renderJavascripts(),
    $helper->renderGoogleAnalytics(),
  
  "\n</body>\n",

"\n</html>";