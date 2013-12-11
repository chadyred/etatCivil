<?php

/**
 * Mariage filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMariageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numeroacte'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroordre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datemariage'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'datereceptioncontrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nomprenomnotaire'     => new sfWidgetFormFilterInput(),
      'officieretatcivil'    => new sfWidgetFormFilterInput(),
      'dateacte'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'heureacte'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'numeroacte'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numeroordre'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datemariage'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datereceptioncontrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nomprenomnotaire'     => new sfValidatorPass(array('required' => false)),
      'officieretatcivil'    => new sfValidatorPass(array('required' => false)),
      'dateacte'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heureacte'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'numeroacte'           => 'Number',
      'numeroordre'          => 'Number',
      'datemariage'          => 'Date',
      'datereceptioncontrat' => 'Date',
      'nomprenomnotaire'     => 'Text',
      'officieretatcivil'    => 'Text',
      'dateacte'             => 'Date',
      'heureacte'            => 'Text',
    );
  }
}
