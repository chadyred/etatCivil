<?php

/**
 * Naissance filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaissanceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numeroacte'         => new sfWidgetFormFilterInput(),
      'numeroordre'        => new sfWidgetFormFilterInput(),
      'typeacte'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dateacte'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'heureacte'          => new sfWidgetFormFilterInput(),
      'datereconnaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieureconnaissance' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'numeroacte'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numeroordre'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'typeacte'           => new sfValidatorPass(array('required' => false)),
      'dateacte'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heureacte'          => new sfValidatorPass(array('required' => false)),
      'datereconnaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieureconnaissance' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'numeroacte'         => 'Number',
      'numeroordre'        => 'Number',
      'typeacte'           => 'Text',
      'dateacte'           => 'Date',
      'heureacte'          => 'Text',
      'datereconnaissance' => 'Date',
      'lieureconnaissance' => 'Text',
    );
  }
}
