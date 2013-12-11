<?php

/**
 * Deces form base class.
 *
 * @method Deces getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDecesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'numeroacte'           => new sfWidgetFormInputText(),
      'numeroordre'          => new sfWidgetFormInputText(),
      'typeacte'             => new sfWidgetFormInputText(),
      'nomdefunt'            => new sfWidgetFormInputText(),
      'prenomdefunt'         => new sfWidgetFormInputText(),
      'sexedefunt'           => new sfWidgetFormInputText(),
      'datedeces'            => new sfWidgetFormDate(),
      'heuredeces'           => new sfWidgetFormTime(),
      'dateapproximative'    => new sfWidgetFormInputText(),
      'lieudeces'            => new sfWidgetFormTextarea(),
      'ruedeces'             => new sfWidgetFormTextarea(),
      'ensondomicile'        => new sfWidgetFormInputText(),
      'professiondefunt'     => new sfWidgetFormInputText(),
      'domiciledefunt'       => new sfWidgetFormTextarea(),
      'datenaissancedefunt'  => new sfWidgetFormDate(),
      'lieunaissancedefunt'  => new sfWidgetFormTextarea(),
      'nomperedefunt'        => new sfWidgetFormInputText(),
      'prenomperedefunt'     => new sfWidgetFormInputText(),
      'nommeredefunt'        => new sfWidgetFormInputText(),
      'prenommeredefunt'     => new sfWidgetFormInputText(),
      'statutmatrimoniale'   => new sfWidgetFormInputText(),
      'nomconjoint'          => new sfWidgetFormInputText(),
      'prenomconjoint'       => new sfWidgetFormInputText(),
      'nomdeclarant'         => new sfWidgetFormInputText(),
      'prenomdeclarant'      => new sfWidgetFormInputText(),
      'sexedeclarant'        => new sfWidgetFormInputText(),
      'agedeclarant'         => new sfWidgetFormInputText(),
      'professiondeclarant'  => new sfWidgetFormInputText(),
      'adressedeclarant'     => new sfWidgetFormTextarea(),
      'officieretatcivil'    => new sfWidgetFormTextarea(),
      'communetranscription' => new sfWidgetFormTextarea(),
      'datetranscription'    => new sfWidgetFormDate(),
      'dateacte'             => new sfWidgetFormDate(),
      'heureacte'            => new sfWidgetFormTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numeroacte'           => new sfValidatorInteger(),
      'numeroordre'          => new sfValidatorInteger(),
      'typeacte'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nomdefunt'            => new sfValidatorString(array('max_length' => 60)),
      'prenomdefunt'         => new sfValidatorString(array('max_length' => 100)),
      'sexedefunt'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datedeces'            => new sfValidatorDate(),
      'heuredeces'           => new sfValidatorTime(),
      'dateapproximative'    => new sfValidatorInteger(array('required' => false)),
      'lieudeces'            => new sfValidatorString(),
      'ruedeces'             => new sfValidatorString(array('required' => false)),
      'ensondomicile'        => new sfValidatorInteger(array('required' => false)),
      'professiondefunt'     => new sfValidatorString(array('max_length' => 70)),
      'domiciledefunt'       => new sfValidatorString(),
      'datenaissancedefunt'  => new sfValidatorDate(),
      'lieunaissancedefunt'  => new sfValidatorString(),
      'nomperedefunt'        => new sfValidatorString(array('max_length' => 90)),
      'prenomperedefunt'     => new sfValidatorString(array('max_length' => 90)),
      'nommeredefunt'        => new sfValidatorString(array('max_length' => 90)),
      'prenommeredefunt'     => new sfValidatorString(array('max_length' => 90)),
      'statutmatrimoniale'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nomconjoint'          => new sfValidatorString(array('max_length' => 90, 'required' => false)),
      'prenomconjoint'       => new sfValidatorString(array('max_length' => 90, 'required' => false)),
      'nomdeclarant'         => new sfValidatorString(array('max_length' => 45)),
      'prenomdeclarant'      => new sfValidatorString(array('max_length' => 45)),
      'sexedeclarant'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'agedeclarant'         => new sfValidatorInteger(),
      'professiondeclarant'  => new sfValidatorString(array('max_length' => 70)),
      'adressedeclarant'     => new sfValidatorString(),
      'officieretatcivil'    => new sfValidatorString(array('required' => false)),
      'communetranscription' => new sfValidatorString(array('required' => false)),
      'datetranscription'    => new sfValidatorDate(array('required' => false)),
      'dateacte'             => new sfValidatorDate(),
      'heureacte'            => new sfValidatorTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('deces[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Deces';
  }

}
