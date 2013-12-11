<?php

/**
 * Mariage_contact form base class.
 *
 * @method Mariage_contact getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMariage_contactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'mariage_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => false)),
      'nom'         => new sfWidgetFormInputText(),
      'prenom'      => new sfWidgetFormInputText(),
      'sexe'        => new sfWidgetFormChoice(array('choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'typeContact' => new sfWidgetFormChoice(array('choices' => array('témoin' => 'témoin', 'père' => 'père', 'mère' => 'mère'))),
      'enRelationA' => new sfWidgetFormChoice(array('choices' => array('conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'info'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'décédé(e)' => 'décédé(e)'))),
      'age'         => new sfWidgetFormInputText(),
      'domicile'    => new sfWidgetFormTextarea(),
      'profession'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'))),
      'nom'         => new sfValidatorString(array('max_length' => 60)),
      'prenom'      => new sfValidatorString(array('max_length' => 60)),
      'sexe'        => new sfValidatorChoice(array('choices' => array(0 => 'masculin', 1 => 'féminin'), 'required' => false)),
      'typeContact' => new sfValidatorChoice(array('choices' => array(0 => 'témoin', 1 => 'père', 2 => 'mère'), 'required' => false)),
      'enRelationA' => new sfValidatorChoice(array('choices' => array(0 => 'conjoint1', 1 => 'conjoint2'), 'required' => false)),
      'info'        => new sfValidatorChoice(array('choices' => array(0 => '', 1 => 'décédé(e)'), 'required' => false)),
      'age'         => new sfValidatorInteger(array('required' => false)),
      'domicile'    => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'profession'  => new sfValidatorString(array('max_length' => 70, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage_contact';
  }

}
