<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version7 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('dm_user', 'forgot_password_code', 'string', '12', array(
             'unique' => '1',
             ));
    }

    public function down()
    {

    }
}