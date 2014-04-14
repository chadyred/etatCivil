<?php

/**
 * NaissanceEnfant filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaissanceEnfantFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naissance_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'nom'                => new sfWidgetFormFilterInput(),
      'prenom'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datenaissance'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'heurenaissance'     => new sfWidgetFormFilterInput(),
      'lieunaissance'      => new sfWidgetFormFilterInput(),
      'nouveaunom'         => new sfWidgetFormFilterInput(),
      'domicile'           => new sfWidgetFormFilterInput(),
      'parentsmaries'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datemariageparents' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'lieumariageparents' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'naissance_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naissance'), 'column' => 'id')),
      'nom'                => new sfValidatorPass(array('required' => false)),
      'prenom'             => new sfValidatorPass(array('required' => false)),
      'sexe'               => new sfValidatorPass(array('required' => false)),
      'datenaissance'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'heurenaissance'     => new sfValidatorPass(array('required' => false)),
      'lieunaissance'      => new sfValidatorPass(array('required' => false)),
      'nouveaunom'         => new sfValidatorPass(array('required' => false)),
      'domicile'           => new sfValidatorPass(array('required' => false)),
      'parentsmaries'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datemariageparents' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieumariageparents' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naissance_enfant_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NaissanceEnfant';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'naissance_id'       => 'ForeignKey',
      'nom'                => 'Text',
      'prenom'             => 'Text',
      'sexe'               => 'Text',
      'datenaissance'      => 'Date',
      'heurenaissance'     => 'Text',
      'lieunaissance'      => 'Text',
      'nouveaunom'         => 'Text',
      'domicile'           => 'Text',
      'parentsmaries'      => 'Number',
      'datemariageparents' => 'Date',
      'lieumariageparents' => 'Text',
    );
  }
}
