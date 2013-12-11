<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Deces', 'doctrine');

/**
 * BaseDeces
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $numeroacte
 * @property integer $numeroordre
 * @property string $typeacte
 * @property string $nomdefunt
 * @property string $prenomdefunt
 * @property string $sexedefunt
 * @property date $datedeces
 * @property time $heuredeces
 * @property integer $dateapproximative
 * @property string $lieudeces
 * @property string $ruedeces
 * @property integer $ensondomicile
 * @property string $professiondefunt
 * @property string $domiciledefunt
 * @property date $datenaissancedefunt
 * @property string $lieunaissancedefunt
 * @property string $nomperedefunt
 * @property string $prenomperedefunt
 * @property string $nommeredefunt
 * @property string $prenommeredefunt
 * @property string $statutmatrimoniale
 * @property string $nomconjoint
 * @property string $prenomconjoint
 * @property string $nomdeclarant
 * @property string $prenomdeclarant
 * @property string $sexedeclarant
 * @property integer $agedeclarant
 * @property string $professiondeclarant
 * @property string $adressedeclarant
 * @property string $officieretatcivil
 * @property string $communetranscription
 * @property date $datetranscription
 * @property date $dateacte
 * @property time $heureacte
 * @property Doctrine_Collection $ImageRegistreDeces
 * @property Doctrine_Collection $MentionMarginaleDeces
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method integer             getNumeroacte()            Returns the current record's "numeroacte" value
 * @method integer             getNumeroordre()           Returns the current record's "numeroordre" value
 * @method string              getTypeacte()              Returns the current record's "typeacte" value
 * @method string              getNomdefunt()             Returns the current record's "nomdefunt" value
 * @method string              getPrenomdefunt()          Returns the current record's "prenomdefunt" value
 * @method string              getSexedefunt()            Returns the current record's "sexedefunt" value
 * @method date                getDatedeces()             Returns the current record's "datedeces" value
 * @method time                getHeuredeces()            Returns the current record's "heuredeces" value
 * @method integer             getDateapproximative()     Returns the current record's "dateapproximative" value
 * @method string              getLieudeces()             Returns the current record's "lieudeces" value
 * @method string              getRuedeces()              Returns the current record's "ruedeces" value
 * @method integer             getEnsondomicile()         Returns the current record's "ensondomicile" value
 * @method string              getProfessiondefunt()      Returns the current record's "professiondefunt" value
 * @method string              getDomiciledefunt()        Returns the current record's "domiciledefunt" value
 * @method date                getDatenaissancedefunt()   Returns the current record's "datenaissancedefunt" value
 * @method string              getLieunaissancedefunt()   Returns the current record's "lieunaissancedefunt" value
 * @method string              getNomperedefunt()         Returns the current record's "nomperedefunt" value
 * @method string              getPrenomperedefunt()      Returns the current record's "prenomperedefunt" value
 * @method string              getNommeredefunt()         Returns the current record's "nommeredefunt" value
 * @method string              getPrenommeredefunt()      Returns the current record's "prenommeredefunt" value
 * @method string              getStatutmatrimoniale()    Returns the current record's "statutmatrimoniale" value
 * @method string              getNomconjoint()           Returns the current record's "nomconjoint" value
 * @method string              getPrenomconjoint()        Returns the current record's "prenomconjoint" value
 * @method string              getNomdeclarant()          Returns the current record's "nomdeclarant" value
 * @method string              getPrenomdeclarant()       Returns the current record's "prenomdeclarant" value
 * @method string              getSexedeclarant()         Returns the current record's "sexedeclarant" value
 * @method integer             getAgedeclarant()          Returns the current record's "agedeclarant" value
 * @method string              getProfessiondeclarant()   Returns the current record's "professiondeclarant" value
 * @method string              getAdressedeclarant()      Returns the current record's "adressedeclarant" value
 * @method string              getOfficieretatcivil()     Returns the current record's "officieretatcivil" value
 * @method string              getCommunetranscription()  Returns the current record's "communetranscription" value
 * @method date                getDatetranscription()     Returns the current record's "datetranscription" value
 * @method date                getDateacte()              Returns the current record's "dateacte" value
 * @method time                getHeureacte()             Returns the current record's "heureacte" value
 * @method Doctrine_Collection getImageRegistreDeces()    Returns the current record's "ImageRegistreDeces" collection
 * @method Doctrine_Collection getMentionMarginaleDeces() Returns the current record's "MentionMarginaleDeces" collection
 * @method Deces               setId()                    Sets the current record's "id" value
 * @method Deces               setNumeroacte()            Sets the current record's "numeroacte" value
 * @method Deces               setNumeroordre()           Sets the current record's "numeroordre" value
 * @method Deces               setTypeacte()              Sets the current record's "typeacte" value
 * @method Deces               setNomdefunt()             Sets the current record's "nomdefunt" value
 * @method Deces               setPrenomdefunt()          Sets the current record's "prenomdefunt" value
 * @method Deces               setSexedefunt()            Sets the current record's "sexedefunt" value
 * @method Deces               setDatedeces()             Sets the current record's "datedeces" value
 * @method Deces               setHeuredeces()            Sets the current record's "heuredeces" value
 * @method Deces               setDateapproximative()     Sets the current record's "dateapproximative" value
 * @method Deces               setLieudeces()             Sets the current record's "lieudeces" value
 * @method Deces               setRuedeces()              Sets the current record's "ruedeces" value
 * @method Deces               setEnsondomicile()         Sets the current record's "ensondomicile" value
 * @method Deces               setProfessiondefunt()      Sets the current record's "professiondefunt" value
 * @method Deces               setDomiciledefunt()        Sets the current record's "domiciledefunt" value
 * @method Deces               setDatenaissancedefunt()   Sets the current record's "datenaissancedefunt" value
 * @method Deces               setLieunaissancedefunt()   Sets the current record's "lieunaissancedefunt" value
 * @method Deces               setNomperedefunt()         Sets the current record's "nomperedefunt" value
 * @method Deces               setPrenomperedefunt()      Sets the current record's "prenomperedefunt" value
 * @method Deces               setNommeredefunt()         Sets the current record's "nommeredefunt" value
 * @method Deces               setPrenommeredefunt()      Sets the current record's "prenommeredefunt" value
 * @method Deces               setStatutmatrimoniale()    Sets the current record's "statutmatrimoniale" value
 * @method Deces               setNomconjoint()           Sets the current record's "nomconjoint" value
 * @method Deces               setPrenomconjoint()        Sets the current record's "prenomconjoint" value
 * @method Deces               setNomdeclarant()          Sets the current record's "nomdeclarant" value
 * @method Deces               setPrenomdeclarant()       Sets the current record's "prenomdeclarant" value
 * @method Deces               setSexedeclarant()         Sets the current record's "sexedeclarant" value
 * @method Deces               setAgedeclarant()          Sets the current record's "agedeclarant" value
 * @method Deces               setProfessiondeclarant()   Sets the current record's "professiondeclarant" value
 * @method Deces               setAdressedeclarant()      Sets the current record's "adressedeclarant" value
 * @method Deces               setOfficieretatcivil()     Sets the current record's "officieretatcivil" value
 * @method Deces               setCommunetranscription()  Sets the current record's "communetranscription" value
 * @method Deces               setDatetranscription()     Sets the current record's "datetranscription" value
 * @method Deces               setDateacte()              Sets the current record's "dateacte" value
 * @method Deces               setHeureacte()             Sets the current record's "heureacte" value
 * @method Deces               setImageRegistreDeces()    Sets the current record's "ImageRegistreDeces" collection
 * @method Deces               setMentionMarginaleDeces() Sets the current record's "MentionMarginaleDeces" collection
 * 
 * @package    etatcivil
 * @subpackage model
 * @author     Boyer Jimmy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDeces extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('deces');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('numeroacte', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('numeroordre', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('typeacte', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'deces',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('nomdefunt', 'string', 60, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 60,
             ));
        $this->hasColumn('prenomdefunt', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('sexedefunt', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'masculin',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('datedeces', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('heuredeces', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('dateapproximative', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('lieudeces', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('ruedeces', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('ensondomicile', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('professiondefunt', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 70,
             ));
        $this->hasColumn('domiciledefunt', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('datenaissancedefunt', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('lieunaissancedefunt', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('nomperedefunt', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('prenomperedefunt', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('nommeredefunt', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('prenommeredefunt', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('statutmatrimoniale', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'célibataire',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('nomconjoint', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('prenomconjoint', 'string', 90, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 90,
             ));
        $this->hasColumn('nomdeclarant', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('prenomdeclarant', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('sexedeclarant', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'masculin',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('agedeclarant', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('professiondeclarant', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 70,
             ));
        $this->hasColumn('adressedeclarant', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('officieretatcivil', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('communetranscription', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('datetranscription', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('dateacte', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('heureacte', 'time', 25, array(
             'type' => 'time',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ImageRegistreDeces', array(
             'local' => 'id',
             'foreign' => 'deces_id'));

        $this->hasMany('MentionMarginaleDeces', array(
             'local' => 'id',
             'foreign' => 'deces_id'));
    }
}