<?php

/**
 * Mention_marginaleMariage form base class.
 *
 * @method Mention_marginaleMariage getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMention_marginaleMariageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mariage_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'mention'    => new sfWidgetFormTextarea(),
      'dateAjout'  => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'required' => false)),
      'mention'    => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'dateAjout'  => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('mention_marginale_mariage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mention_marginaleMariage';
  }

}
