<?php

/**
 * VilleFrance filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVilleFranceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cp'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ville'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'region'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'departement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pays'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cp'          => new sfValidatorPass(array('required' => false)),
      'ville'       => new sfValidatorPass(array('required' => false)),
      'region'      => new sfValidatorPass(array('required' => false)),
      'departement' => new sfValidatorPass(array('required' => false)),
      'pays'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ville_france_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VilleFrance';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'cp'          => 'Text',
      'ville'       => 'Text',
      'region'      => 'Text',
      'departement' => 'Text',
      'pays'        => 'Text',
    );
  }
}
