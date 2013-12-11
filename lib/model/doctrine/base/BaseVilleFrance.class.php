<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('VilleFrance', 'doctrine');

/**
 * BaseVilleFrance
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $cp
 * @property string $ville
 * @property string $region
 * @property string $departement
 * @property string $pays
 * 
 * @method integer     getId()          Returns the current record's "id" value
 * @method string      getCp()          Returns the current record's "cp" value
 * @method string      getVille()       Returns the current record's "ville" value
 * @method string      getRegion()      Returns the current record's "region" value
 * @method string      getDepartement() Returns the current record's "departement" value
 * @method string      getPays()        Returns the current record's "pays" value
 * @method VilleFrance setId()          Sets the current record's "id" value
 * @method VilleFrance setCp()          Sets the current record's "cp" value
 * @method VilleFrance setVille()       Sets the current record's "ville" value
 * @method VilleFrance setRegion()      Sets the current record's "region" value
 * @method VilleFrance setDepartement() Sets the current record's "departement" value
 * @method VilleFrance setPays()        Sets the current record's "pays" value
 * 
 * @package    etatcivil
 * @subpackage model
 * @author     Boyer Jimmy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVilleFrance extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ville_france');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('cp', 'string', 5, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 5,
             ));
        $this->hasColumn('ville', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('region', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 40,
             ));
        $this->hasColumn('departement', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('pays', 'string', 40, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 40,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}