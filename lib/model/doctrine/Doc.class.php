<?php

/**
 * Doc
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    diemSite
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
class Doc extends BaseDoc
{
  public function getFullName()
  {
    return $this->get('name').' '.$this->get('Branch')->get('number');
  }
}
