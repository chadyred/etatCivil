<?php

/**
 * Image_registreNaissance form base class.
 *
 * @method Image_registreNaissance getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImage_registreNaissanceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'naissance_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'nomImage'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'naissance_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'required' => false)),
      'nomImage'     => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_registre_naissance[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image_registreNaissance';
  }

}
