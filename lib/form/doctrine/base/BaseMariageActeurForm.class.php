<?php

/**
 * MariageActeur form base class.
 *
 * @method MariageActeur getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMariageActeurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'mariage_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => false)),
      'nom'                   => new sfWidgetFormInputText(),
      'prenom'                => new sfWidgetFormInputText(),
      'sexe'                  => new sfWidgetFormInputText(),
      'typeacteur'            => new sfWidgetFormInputText(),
      'datenaissance'         => new sfWidgetFormDate(),
      'lieunaissance'         => new sfWidgetFormTextarea(),
      'domicile'              => new sfWidgetFormTextarea(),
      'residence'             => new sfWidgetFormTextarea(),
      'profession'            => new sfWidgetFormInputText(),
      'etatanterieurmariage'  => new sfWidgetFormInputText(),
      'nomprenomprecconjoint' => new sfWidgetFormInputText(),
      'nomapresmariage'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'))),
      'nom'                   => new sfValidatorString(array('max_length' => 60)),
      'prenom'                => new sfValidatorString(array('max_length' => 60)),
      'sexe'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typeacteur'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datenaissance'         => new sfValidatorDate(),
      'lieunaissance'         => new sfValidatorString(),
      'domicile'              => new sfValidatorString(),
      'residence'             => new sfValidatorString(array('required' => false)),
      'profession'            => new sfValidatorString(array('max_length' => 70)),
      'etatanterieurmariage'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nomprenomprecconjoint' => new sfValidatorString(array('max_length' => 90, 'required' => false)),
      'nomapresmariage'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_acteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MariageActeur';
  }

}
