<?php

/**
 * Naissance form base class.
 *
 * @method Naissance getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaissanceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'numeroacte'         => new sfWidgetFormInputText(),
      'numeroordre'        => new sfWidgetFormInputText(),
      'typeacte'           => new sfWidgetFormInputText(),
      'dateacte'           => new sfWidgetFormDate(),
      'heureacte'          => new sfWidgetFormTime(),
      'datereconnaissance' => new sfWidgetFormDate(),
      'lieureconnaissance' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numeroacte'         => new sfValidatorInteger(array('required' => false)),
      'numeroordre'        => new sfValidatorInteger(array('required' => false)),
      'typeacte'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dateacte'           => new sfValidatorDate(),
      'heureacte'          => new sfValidatorTime(array('required' => false)),
      'datereconnaissance' => new sfValidatorDate(array('required' => false)),
      'lieureconnaissance' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance';
  }

}
