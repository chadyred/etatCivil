<?php

/**
 * NaissanceEnfant form base class.
 *
 * @method NaissanceEnfant getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNaissanceEnfantForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'naissance_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => false)),
      'nom'                => new sfWidgetFormInputText(),
      'prenom'             => new sfWidgetFormInputText(),
      'sexe'               => new sfWidgetFormInputText(),
      'datenaissance'      => new sfWidgetFormDate(),
      'heurenaissance'     => new sfWidgetFormTime(),
      'lieunaissance'      => new sfWidgetFormTextarea(),
      'nouveaunom'         => new sfWidgetFormInputText(),
      'domicile'           => new sfWidgetFormTextarea(),
      'parentsmaries'      => new sfWidgetFormInputText(),
      'datemariageparents' => new sfWidgetFormDate(),
      'lieumariageparents' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'naissance_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'))),
      'nom'                => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'prenom'             => new sfValidatorString(array('max_length' => 60)),
      'sexe'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datenaissance'      => new sfValidatorDate(array('required' => false)),
      'heurenaissance'     => new sfValidatorTime(array('required' => false)),
      'lieunaissance'      => new sfValidatorString(array('required' => false)),
      'nouveaunom'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'domicile'           => new sfValidatorString(array('required' => false)),
      'parentsmaries'      => new sfValidatorInteger(array('required' => false)),
      'datemariageparents' => new sfValidatorDate(array('required' => false)),
      'lieumariageparents' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_enfant[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NaissanceEnfant';
  }

}
