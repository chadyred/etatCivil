<?php

/**
 * Image_registreMariage form base class.
 *
 * @method Image_registreMariage getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImage_registreMariageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'mariage_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nomImage'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'required' => false)),
      'nomImage'   => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_registre_mariage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image_registreMariage';
  }

}
