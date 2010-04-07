<?php

class myGeshiMarkdown extends dmMarkdown
{
  protected
  $cacheManager;
  
  public function __construct(dmHelper $helper, dmCacheManager $cacheManager, array $options = array())
  {
    $this->cacheManager = $cacheManager;
    
    parent::__construct($helper, $options);
  }
  
  public function getDefaultOptions()
  {
    return array_merge(parent::getDefaultOptions(), array(
      'use_cache' => true
    ));
  }
  
  protected function preTransform($text)
  {
    $text = parent::preTransform($text);
    
    if (strpos($text, '[/code]'))
    {
      $text = preg_replace_callback(
        '#\[code\s?(\w*)\]((?:\n|.)*)\n\[/code\]#uU',
        array($this, 'formatCode'),
        $text
      );
    }

    if(strpos($text, '%latest_diem_version%'))
    {
      $version = dmDb::pdo(
        'SELECT v.number FROM version v INNER JOIN branch b ON v.branch_id = b.id AND b.number = ? WHERE v.is_active = ? ORDER BY v.position ASC LIMIT 1',
        array('5.0', true)
      )
      ->fetchColumn();
      
      $text = str_replace('%latest_diem_version%', $version, $text);
    }

    if(strpos($text, '%latest_diem_download_url%'))
    {
      $version = dmDb::query('Version v')
      ->innerJoin('v.Branch b')
      ->where('b.number = ?', '5.0')
      ->andWhere('v.is_active = ?', true)
      ->orderBy('v.position ASC')
      ->fetchOne();

      $text = str_replace('%latest_diem_download_url%', $this->helper->link($version->downloadUrl)->getAbsoluteHref(), $text);
    }
    
    return $text;
  }
  
  protected function formatCode(array $matches)
  {
    // no language specified
    if (!$matches[1])
    {
      $html = '<pre><code>'.$matches[2].'</code></pre>';
      
      $html = dmString::str_replace_once("\n", '', $html);
      
      $html = dmString::str_replace_once('  ', '', $html);
      
      return $html;
    }
    else
    {
      return $this->formatGeshiCode($matches);
    }
  }

  protected function formatGeshiCode(array $matches)
  {
    $code = $matches[2];
    $language = $matches[1];
    
    $cacheKey = md5($code.$language);
    
    if ($this->getOption('use_cache') && $cache = $this->cacheManager->getCache('markdown')->get($cacheKey))
    {
      return $cache;
    }
    
    $code = html_entity_decode($code);
    
    require_once(dmOs::join(sfConfig::get('sf_lib_dir'), 'vendor/geshi/geshi.php'));
    
    $geshi = new GeSHi($code, $language);
    $geshi->enable_classes();
    
    $html = $geshi->parse_code();
    
    $html = dmString::str_replace_once('>&nbsp;', '>', $html);
    
    $html = dmString::str_replace_once("\n<span class=\"kw2\">&lt;?php</span>", '', $html);
    
    $html = dmString::str_replace_once("\n", '', $html);
    
    $html = dmString::str_replace_once('  ', '', $html);
    
    if ($this->getOption('use_cache'))
    {
      $this->cacheManager->getCache('markdown')->set($cacheKey, $html);
    }
    
    return $html;
  }
  
}