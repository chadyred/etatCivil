<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version6 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('mariage_acteur', 'sexe', 'enum', '', array(
             'values' => 
             array(
              0 => 'homme',
              1 => 'femme',
             ),
             'default' => 'homme',
             'notnull' => 'homme',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {

    }
}