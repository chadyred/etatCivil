<?php

/**
 * Naissance_acteur form base class.
 *
 * @method Naissance_acteur getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaissance_acteurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'naissance_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => false)),
      'nom'           => new sfWidgetFormInputText(),
      'prenom'        => new sfWidgetFormInputText(),
      'sexe'          => new sfWidgetFormChoice(array('choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'age'           => new sfWidgetFormInputText(),
      'dateNaissance' => new sfWidgetFormDate(),
      'lieuNaissance' => new sfWidgetFormTextarea(),
      'profession'    => new sfWidgetFormInputText(),
      'domicile'      => new sfWidgetFormTextarea(),
      'estDeclarant'  => new sfWidgetFormInputCheckbox(),
      'typeActeur'    => new sfWidgetFormChoice(array('choices' => array('père' => 'père', 'mère' => 'mère', 'autre préciser...' => 'autre préciser...'))),
      'typeAutres'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'naissance_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'))),
      'nom'           => new sfValidatorString(array('max_length' => 60)),
      'prenom'        => new sfValidatorString(array('max_length' => 60)),
      'sexe'          => new sfValidatorChoice(array('choices' => array(0 => 'masculin', 1 => 'féminin'), 'required' => false)),
      'age'           => new sfValidatorInteger(array('required' => false)),
      'dateNaissance' => new sfValidatorDate(array('required' => false)),
      'lieuNaissance' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'profession'    => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'domicile'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'estDeclarant'  => new sfValidatorBoolean(array('required' => false)),
      'typeActeur'    => new sfValidatorChoice(array('choices' => array(0 => 'père', 1 => 'mère', 2 => 'autre préciser...'), 'required' => false)),
      'typeAutres'    => new sfValidatorString(array('max_length' => 70, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_acteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance_acteur';
  }

}
