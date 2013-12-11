<?php

/**
 * Ville_france form base class.
 *
 * @method Ville_france getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVille_franceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'CP'          => new sfWidgetFormInputText(),
      'Ville'       => new sfWidgetFormInputText(),
      'Region'      => new sfWidgetFormInputText(),
      'Departement' => new sfWidgetFormInputText(),
      'Pays'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'CP'          => new sfValidatorString(array('max_length' => 5)),
      'Ville'       => new sfValidatorString(array('max_length' => 50)),
      'Region'      => new sfValidatorString(array('max_length' => 40)),
      'Departement' => new sfValidatorString(array('max_length' => 60)),
      'Pays'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ville_france[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ville_france';
  }

}
