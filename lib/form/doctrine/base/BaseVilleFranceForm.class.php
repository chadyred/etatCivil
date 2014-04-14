<?php

/**
 * VilleFrance form base class.
 *
 * @method VilleFrance getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVilleFranceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'cp'          => new sfWidgetFormInputText(),
      'ville'       => new sfWidgetFormInputText(),
      'region'      => new sfWidgetFormInputText(),
      'departement' => new sfWidgetFormInputText(),
      'pays'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cp'          => new sfValidatorString(array('max_length' => 5)),
      'ville'       => new sfValidatorString(array('max_length' => 50)),
      'region'      => new sfValidatorString(array('max_length' => 40)),
      'departement' => new sfValidatorString(array('max_length' => 60)),
      'pays'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ville_france[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VilleFrance';
  }

}
