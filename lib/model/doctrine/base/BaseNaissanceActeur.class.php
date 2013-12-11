<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('NaissanceActeur', 'doctrine');

/**
 * BaseNaissanceActeur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $naissance_id
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property integer $age
 * @property date $datenaissance
 * @property string $lieunaissance
 * @property string $profession
 * @property string $domicile
 * @property integer $estdeclarant
 * @property string $typeacteur
 * @property string $typeautres
 * @property Naissance $Naissance
 * 
 * @method integer         getId()            Returns the current record's "id" value
 * @method integer         getNaissanceId()   Returns the current record's "naissance_id" value
 * @method string          getNom()           Returns the current record's "nom" value
 * @method string          getPrenom()        Returns the current record's "prenom" value
 * @method string          getSexe()          Returns the current record's "sexe" value
 * @method integer         getAge()           Returns the current record's "age" value
 * @method date            getDatenaissance() Returns the current record's "datenaissance" value
 * @method string          getLieunaissance() Returns the current record's "lieunaissance" value
 * @method string          getProfession()    Returns the current record's "profession" value
 * @method string          getDomicile()      Returns the current record's "domicile" value
 * @method integer         getEstdeclarant()  Returns the current record's "estdeclarant" value
 * @method string          getTypeacteur()    Returns the current record's "typeacteur" value
 * @method string          getTypeautres()    Returns the current record's "typeautres" value
 * @method Naissance       getNaissance()     Returns the current record's "Naissance" value
 * @method NaissanceActeur setId()            Sets the current record's "id" value
 * @method NaissanceActeur setNaissanceId()   Sets the current record's "naissance_id" value
 * @method NaissanceActeur setNom()           Sets the current record's "nom" value
 * @method NaissanceActeur setPrenom()        Sets the current record's "prenom" value
 * @method NaissanceActeur setSexe()          Sets the current record's "sexe" value
 * @method NaissanceActeur setAge()           Sets the current record's "age" value
 * @method NaissanceActeur setDatenaissance() Sets the current record's "datenaissance" value
 * @method NaissanceActeur setLieunaissance() Sets the current record's "lieunaissance" value
 * @method NaissanceActeur setProfession()    Sets the current record's "profession" value
 * @method NaissanceActeur setDomicile()      Sets the current record's "domicile" value
 * @method NaissanceActeur setEstdeclarant()  Sets the current record's "estdeclarant" value
 * @method NaissanceActeur setTypeacteur()    Sets the current record's "typeacteur" value
 * @method NaissanceActeur setTypeautres()    Sets the current record's "typeautres" value
 * @method NaissanceActeur setNaissance()     Sets the current record's "Naissance" value
 * 
 * @package    etatcivil
 * @subpackage model
 * @author     Boyer Jimmy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNaissanceActeur extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('naissance_acteur');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('naissance_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('nom', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('prenom', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('sexe', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'masculin',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('age', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('datenaissance', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('lieunaissance', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('profession', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 70,
             ));
        $this->hasColumn('domicile', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('estdeclarant', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('typeacteur', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'père',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('typeautres', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 70,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Naissance', array(
             'local' => 'naissance_id',
             'foreign' => 'id'));
    }
}