<?php

/**
 * Naissance_acteur filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaissance_acteurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naissance_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'nom'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'masculin' => 'masculin', 'féminin' => 'féminin'))),
      'age'           => new sfWidgetFormFilterInput(),
      'dateNaissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieuNaissance' => new sfWidgetFormFilterInput(),
      'profession'    => new sfWidgetFormFilterInput(),
      'domicile'      => new sfWidgetFormFilterInput(),
      'estDeclarant'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'typeActeur'    => new sfWidgetFormChoice(array('choices' => array('' => '', 'père' => 'père', 'mère' => 'mère', 'autre préciser...' => 'autre préciser...'))),
      'typeAutres'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'naissance_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naissance'), 'column' => 'id')),
      'nom'           => new sfValidatorPass(array('required' => false)),
      'prenom'        => new sfValidatorPass(array('required' => false)),
      'sexe'          => new sfValidatorChoice(array('required' => false, 'choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'age'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dateNaissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieuNaissance' => new sfValidatorPass(array('required' => false)),
      'profession'    => new sfValidatorPass(array('required' => false)),
      'domicile'      => new sfValidatorPass(array('required' => false)),
      'estDeclarant'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'typeActeur'    => new sfValidatorChoice(array('required' => false, 'choices' => array('père' => 'père', 'mère' => 'mère', 'autre préciser...' => 'autre préciser...'))),
      'typeAutres'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_acteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naissance_acteur';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'naissance_id'  => 'ForeignKey',
      'nom'           => 'Text',
      'prenom'        => 'Text',
      'sexe'          => 'Enum',
      'age'           => 'Number',
      'dateNaissance' => 'Date',
      'lieuNaissance' => 'Text',
      'profession'    => 'Text',
      'domicile'      => 'Text',
      'estDeclarant'  => 'Boolean',
      'typeActeur'    => 'Enum',
      'typeAutres'    => 'Text',
    );
  }
}