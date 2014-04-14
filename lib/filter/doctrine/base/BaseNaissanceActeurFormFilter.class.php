<?php

/**
 * NaissanceActeur filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaissanceActeurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naissance_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'nom'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'age'           => new sfWidgetFormFilterInput(),
      'datenaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieunaissance' => new sfWidgetFormFilterInput(),
      'profession'    => new sfWidgetFormFilterInput(),
      'domicile'      => new sfWidgetFormFilterInput(),
      'estdeclarant'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeacteur'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeautres'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'naissance_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naissance'), 'column' => 'id')),
      'nom'           => new sfValidatorPass(array('required' => false)),
      'prenom'        => new sfValidatorPass(array('required' => false)),
      'sexe'          => new sfValidatorPass(array('required' => false)),
      'age'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datenaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieunaissance' => new sfValidatorPass(array('required' => false)),
      'profession'    => new sfValidatorPass(array('required' => false)),
      'domicile'      => new sfValidatorPass(array('required' => false)),
      'estdeclarant'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typeacteur'    => new sfValidatorPass(array('required' => false)),
      'typeautres'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_acteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NaissanceActeur';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'naissance_id'  => 'ForeignKey',
      'nom'           => 'Text',
      'prenom'        => 'Text',
      'sexe'          => 'Text',
      'age'           => 'Number',
      'datenaissance' => 'Date',
      'lieunaissance' => 'Text',
      'profession'    => 'Text',
      'domicile'      => 'Text',
      'estdeclarant'  => 'Number',
      'typeacteur'    => 'Text',
      'typeautres'    => 'Text',
    );
  }
}
