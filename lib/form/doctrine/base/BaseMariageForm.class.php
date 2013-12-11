<?php

/**
 * Mariage form base class.
 *
 * @method Mariage getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMariageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'numeroacte'           => new sfWidgetFormInputText(),
      'numeroordre'          => new sfWidgetFormInputText(),
      'datemariage'          => new sfWidgetFormDate(),
      'datereceptioncontrat' => new sfWidgetFormDate(),
      'nomprenomnotaire'     => new sfWidgetFormInputText(),
      'officieretatcivil'    => new sfWidgetFormTextarea(),
      'dateacte'             => new sfWidgetFormDate(),
      'heureacte'            => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numeroacte'           => new sfValidatorInteger(),
      'numeroordre'          => new sfValidatorInteger(),
      'datemariage'          => new sfValidatorDate(),
      'datereceptioncontrat' => new sfValidatorDate(array('required' => false)),
      'nomprenomnotaire'     => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'officieretatcivil'    => new sfValidatorString(array('required' => false)),
      'dateacte'             => new sfValidatorDate(),
      'heureacte'            => new sfValidatorTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage';
  }

}
