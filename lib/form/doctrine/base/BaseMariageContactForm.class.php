<?php

/**
 * MariageContact form base class.
 *
 * @method MariageContact getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMariageContactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'mariage_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => false)),
      'nom'         => new sfWidgetFormInputText(),
      'prenom'      => new sfWidgetFormInputText(),
      'sexe'        => new sfWidgetFormInputText(),
      'typecontact' => new sfWidgetFormInputText(),
      'enrelationa' => new sfWidgetFormInputText(),
      'info'        => new sfWidgetFormInputText(),
      'age'         => new sfWidgetFormInputText(),
      'domicile'    => new sfWidgetFormTextarea(),
      'profession'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'))),
      'nom'         => new sfValidatorString(array('max_length' => 60)),
      'prenom'      => new sfValidatorString(array('max_length' => 60)),
      'sexe'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typecontact' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'enrelationa' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'info'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'age'         => new sfValidatorInteger(array('required' => false)),
      'domicile'    => new sfValidatorString(array('required' => false)),
      'profession'  => new sfValidatorString(array('max_length' => 70, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MariageContact';
  }

}
