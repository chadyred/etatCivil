<?php

/**
 * Utilisateur form base class.
 *
 * @method Utilisateur getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUtilisateurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'login'    => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputText(),
      'droits'   => new sfWidgetFormInputText(),
      'nom'      => new sfWidgetFormInputText(),
      'prenom'   => new sfWidgetFormInputText(),
      'fonction' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'login'    => new sfValidatorString(array('max_length' => 20)),
      'password' => new sfValidatorString(array('max_length' => 20)),
      'droits'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nom'      => new sfValidatorString(array('max_length' => 45)),
      'prenom'   => new sfValidatorString(array('max_length' => 45)),
      'fonction' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('utilisateur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utilisateur';
  }

}
