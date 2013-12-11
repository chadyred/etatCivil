<?php

/**
 * Notaires filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNotairesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'adresse' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nom'     => new sfValidatorPass(array('required' => false)),
      'prenom'  => new sfValidatorPass(array('required' => false)),
      'adresse' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('notaires_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notaires';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'nom'     => 'Text',
      'prenom'  => 'Text',
      'adresse' => 'Text',
    );
  }
}
