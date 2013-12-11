<?php

/**
 * Utilisateur filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUtilisateurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'login'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'droits'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nom'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fonction' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'login'    => new sfValidatorPass(array('required' => false)),
      'password' => new sfValidatorPass(array('required' => false)),
      'droits'   => new sfValidatorPass(array('required' => false)),
      'nom'      => new sfValidatorPass(array('required' => false)),
      'prenom'   => new sfValidatorPass(array('required' => false)),
      'fonction' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('utilisateur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Utilisateur';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'login'    => 'Text',
      'password' => 'Text',
      'droits'   => 'Text',
      'nom'      => 'Text',
      'prenom'   => 'Text',
      'fonction' => 'Text',
    );
  }
}
