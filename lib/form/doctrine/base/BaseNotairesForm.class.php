<?php

/**
 * Notaires form base class.
 *
 * @method Notaires getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotairesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'nom'     => new sfWidgetFormInputText(),
      'prenom'  => new sfWidgetFormInputText(),
      'adresse' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'     => new sfValidatorString(array('max_length' => 90)),
      'prenom'  => new sfValidatorString(array('max_length' => 90)),
      'adresse' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('notaires[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notaires';
  }

}
