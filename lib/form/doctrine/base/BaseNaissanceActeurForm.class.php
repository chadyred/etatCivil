<?php

/**
 * NaissanceActeur form base class.
 *
 * @method NaissanceActeur getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaissanceActeurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'naissance_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => false)),
      'nom'           => new sfWidgetFormInputText(),
      'prenom'        => new sfWidgetFormInputText(),
      'sexe'          => new sfWidgetFormInputText(),
      'age'           => new sfWidgetFormInputText(),
      'datenaissance' => new sfWidgetFormDate(),
      'lieunaissance' => new sfWidgetFormTextarea(),
      'profession'    => new sfWidgetFormInputText(),
      'domicile'      => new sfWidgetFormTextarea(),
      'estdeclarant'  => new sfWidgetFormInputText(),
      'typeacteur'    => new sfWidgetFormInputText(),
      'typeautres'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'naissance_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'))),
      'nom'           => new sfValidatorString(array('max_length' => 60)),
      'prenom'        => new sfValidatorString(array('max_length' => 60)),
      'sexe'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'age'           => new sfValidatorInteger(array('required' => false)),
      'datenaissance' => new sfValidatorDate(array('required' => false)),
      'lieunaissance' => new sfValidatorString(array('required' => false)),
      'profession'    => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'domicile'      => new sfValidatorString(array('required' => false)),
      'estdeclarant'  => new sfValidatorInteger(array('required' => false)),
      'typeacteur'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typeautres'    => new sfValidatorString(array('max_length' => 70, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_acteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NaissanceActeur';
  }

}
