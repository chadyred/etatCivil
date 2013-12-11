<?php

/**
 * Deces filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDecesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numeroacte'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroordre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeacte'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomdefunt'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenomdefunt'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexedefunt'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datedeces'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'heuredeces'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dateapproximative'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lieudeces'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ruedeces'             => new sfWidgetFormFilterInput(),
      'ensondomicile'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'professiondefunt'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domiciledefunt'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datenaissancedefunt'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lieunaissancedefunt'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomperedefunt'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenomperedefunt'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nommeredefunt'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenommeredefunt'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'statutmatrimoniale'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomconjoint'          => new sfWidgetFormFilterInput(),
      'prenomconjoint'       => new sfWidgetFormFilterInput(),
      'nomdeclarant'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenomdeclarant'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexedeclarant'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'agedeclarant'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'professiondeclarant'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'adressedeclarant'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'officieretatcivil'    => new sfWidgetFormFilterInput(),
      'communetranscription' => new sfWidgetFormFilterInput(),
      'datetranscription'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dateacte'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'heureacte'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'numeroacte'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numeroordre'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typeacte'             => new sfValidatorPass(array('required' => false)),
      'nomdefunt'            => new sfValidatorPass(array('required' => false)),
      'prenomdefunt'         => new sfValidatorPass(array('required' => false)),
      'sexedefunt'           => new sfValidatorPass(array('required' => false)),
      'datedeces'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heuredeces'           => new sfValidatorPass(array('required' => false)),
      'dateapproximative'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lieudeces'            => new sfValidatorPass(array('required' => false)),
      'ruedeces'             => new sfValidatorPass(array('required' => false)),
      'ensondomicile'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'professiondefunt'     => new sfValidatorPass(array('required' => false)),
      'domiciledefunt'       => new sfValidatorPass(array('required' => false)),
      'datenaissancedefunt'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieunaissancedefunt'  => new sfValidatorPass(array('required' => false)),
      'nomperedefunt'        => new sfValidatorPass(array('required' => false)),
      'prenomperedefunt'     => new sfValidatorPass(array('required' => false)),
      'nommeredefunt'        => new sfValidatorPass(array('required' => false)),
      'prenommeredefunt'     => new sfValidatorPass(array('required' => false)),
      'statutmatrimoniale'   => new sfValidatorPass(array('required' => false)),
      'nomconjoint'          => new sfValidatorPass(array('required' => false)),
      'prenomconjoint'       => new sfValidatorPass(array('required' => false)),
      'nomdeclarant'         => new sfValidatorPass(array('required' => false)),
      'prenomdeclarant'      => new sfValidatorPass(array('required' => false)),
      'sexedeclarant'        => new sfValidatorPass(array('required' => false)),
      'agedeclarant'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'professiondeclarant'  => new sfValidatorPass(array('required' => false)),
      'adressedeclarant'     => new sfValidatorPass(array('required' => false)),
      'officieretatcivil'    => new sfValidatorPass(array('required' => false)),
      'communetranscription' => new sfValidatorPass(array('required' => false)),
      'datetranscription'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dateacte'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heureacte'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('deces_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Deces';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'numeroacte'           => 'Number',
      'numeroordre'          => 'Number',
      'typeacte'             => 'Text',
      'nomdefunt'            => 'Text',
      'prenomdefunt'         => 'Text',
      'sexedefunt'           => 'Text',
      'datedeces'            => 'Date',
      'heuredeces'           => 'Text',
      'dateapproximative'    => 'Number',
      'lieudeces'            => 'Text',
      'ruedeces'             => 'Text',
      'ensondomicile'        => 'Number',
      'professiondefunt'     => 'Text',
      'domiciledefunt'       => 'Text',
      'datenaissancedefunt'  => 'Date',
      'lieunaissancedefunt'  => 'Text',
      'nomperedefunt'        => 'Text',
      'prenomperedefunt'     => 'Text',
      'nommeredefunt'        => 'Text',
      'prenommeredefunt'     => 'Text',
      'statutmatrimoniale'   => 'Text',
      'nomconjoint'          => 'Text',
      'prenomconjoint'       => 'Text',
      'nomdeclarant'         => 'Text',
      'prenomdeclarant'      => 'Text',
      'sexedeclarant'        => 'Text',
      'agedeclarant'         => 'Number',
      'professiondeclarant'  => 'Text',
      'adressedeclarant'     => 'Text',
      'officieretatcivil'    => 'Text',
      'communetranscription' => 'Text',
      'datetranscription'    => 'Date',
      'dateacte'             => 'Date',
      'heureacte'            => 'Text',
    );
  }
}
