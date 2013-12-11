<?php

/**
 * Naissance_enfant filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaissance_enfantFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naissance_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'nom'                => new sfWidgetFormFilterInput(),
      'prenom'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'masculin' => 'masculin', 'féminin' => 'féminin'))),
      'dateNaissance'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'heureNaissance'     => new sfWidgetFormFilterInput(),
      'lieuNaissance'      => new sfWidgetFormFilterInput(),
      'nouveauNom'         => new sfWidgetFormFilterInput(),
      'domicile'           => new sfWidgetFormFilterInput(),
      'parentsMaries'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'dateMariageParents' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieuMariageParents' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'naissance_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naissance'), 'column' => 'id')),
      'nom'                => new sfValidatorPass(array('required' => false)),
      'prenom'             => new sfValidatorPass(array('required' => false)),
      'sexe'               => new sfValidatorChoice(array('required' => false, 'choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'dateNaissance'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heureNaissance'     => new sfValidatorPass(array('required' => false)),
      'lieuNaissance'      => new sfValidatorPass(array('required' => false)),
      'nouveauNom'         => new sfValidatorPass(array('required' => false)),
      'domicile'           => new sfValidatorPass(array('required' => false)),
      'parentsMaries'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'dateMariageParents' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieuMariageParents' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_enfant_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance_enfant';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'naissance_id'       => 'ForeignKey',
      'nom'                => 'Text',
      'prenom'             => 'Text',
      'sexe'               => 'Enum',
      'dateNaissance'      => 'Date',
      'heureNaissance'     => 'Text',
      'lieuNaissance'      => 'Text',
      'nouveauNom'         => 'Text',
      'domicile'           => 'Text',
      'parentsMaries'      => 'Boolean',
      'dateMariageParents' => 'Date',
      'lieuMariageParents' => 'Text',
    );
  }
}
