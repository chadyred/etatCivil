<?php

/**
 * MentionMarginaleMariage form base class.
 *
 * @method MentionMarginaleMariage getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMentionMarginaleMariageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mariage_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'mention'    => new sfWidgetFormTextarea(),
      'dateajout'  => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'required' => false)),
      'mention'    => new sfValidatorString(array('required' => false)),
      'dateajout'  => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('mention_marginale_mariage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MentionMarginaleMariage';
  }

}
