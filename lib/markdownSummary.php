<?php

class markdownSummary
{
  protected
  $markdownParser;
  
  public function __construct(dmMarkdown $markdownParser)
  {
    $this->markdownParser = $markdownParser;
  }
  
  public function render($text)
  {
    return $this->renderStack($this->getStack($this->markdownParser->toHtml($text)));
  }
  
  protected function renderStack($stack)
  {
    if (empty($stack))
    {
      return '';
    }
    
    $html = '<ul>';
    
    $firstLevel = $prevLevel = $stack[0]['level'];
    $stackLength = count($stack);
    foreach($stack as $key => $header)
    {
      $level = $header['level'];
      $nextLevel = $key < ($stackLength-1) ? $stack[$key+1]['level'] : $firstLevel;
      
      $link = '<a href="#'.$header['id'].'">'.$header['text'].'</a>';
      
      if ($level === $prevLevel)
      {
        $html .= '<li>'.$link;
        $html .= $level < $nextLevel ? '' : '</li>';
      }
      elseif ($level < $prevLevel)
      {
        $html .= str_repeat('</ul></li>', $prevLevel-$level).'<li>'.$link;
        $html .= $level < $nextLevel ? '' : '</li>';
      }
      elseif ($level > $prevLevel)
      {
        $html .= '<ul><li>'.$link;
        $html .= $level < $nextLevel ? '' : '</li>';
      }
      
      $prevLevel = $level;
    }
    
    $html .= str_repeat('</ul></li>', $level - $firstLevel);
    $html .= '</ul>';
    
    return $html;
    $html = str_replace('>', ">\n", $html);
    dmDebug::kill($html);
  }
  
  protected function getStack($html)
  {
    preg_match_all(
      '#<h(\d)\sid="([^"]+)">([^>]+)<#uUx',
      $html,
      $matches
    );
    
    if (empty($matches))
    {
      return null;
    }
    
    $stack = array();
    for($it=0, $itMax=count($matches[1]); $it<$itMax; $it++)
    {
      $stack[] = array(
        'level' => $matches[1][$it],
        'id'    => $matches[2][$it],
        'text'  => $matches[3][$it]
      );
    }
    unset($matches);
    
    return $stack;
  }

}