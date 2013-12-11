<?php

/**
 * Naissance_enfant form base class.
 *
 * @method Naissance_enfant getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaissance_enfantForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'naissance_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => false)),
      'nom'                => new sfWidgetFormInputText(),
      'prenom'             => new sfWidgetFormInputText(),
      'sexe'               => new sfWidgetFormChoice(array('choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'dateNaissance'      => new sfWidgetFormDate(),
      'heureNaissance'     => new sfWidgetFormTime(),
      'lieuNaissance'      => new sfWidgetFormTextarea(),
      'nouveauNom'         => new sfWidgetFormInputText(),
      'domicile'           => new sfWidgetFormTextarea(),
      'parentsMaries'      => new sfWidgetFormInputCheckbox(),
      'dateMariageParents' => new sfWidgetFormDate(),
      'lieuMariageParents' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'naissance_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'))),
      'nom'                => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'prenom'             => new sfValidatorString(array('max_length' => 60)),
      'sexe'               => new sfValidatorChoice(array('choices' => array(0 => 'masculin', 1 => 'féminin'), 'required' => false)),
      'dateNaissance'      => new sfValidatorDate(array('required' => false)),
      'heureNaissance'     => new sfValidatorTime(array('required' => false)),
      'lieuNaissance'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'nouveauNom'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'domicile'           => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'parentsMaries'      => new sfValidatorBoolean(array('required' => false)),
      'dateMariageParents' => new sfValidatorDate(array('required' => false)),
      'lieuMariageParents' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Naissance_enfant', 'column' => array('naissance_id')))
    );

    $this->widgetSchema->setNameFormat('naissance_enfant[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance_enfant';
  }

}
