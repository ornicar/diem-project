<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->removeColumn('dm_user', 'uid');
    }

    public function down()
    {
        $this->addColumn('dm_user', 'uid', 'string', '8', array(
             'unique' => '1',
             ));
    }
}