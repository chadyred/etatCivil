<?php

/**
 * MariageActeur filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMariageActeurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mariage_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nom'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typeacteur'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datenaissance'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lieunaissance'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicile'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'residence'             => new sfWidgetFormFilterInput(),
      'profession'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'etatanterieurmariage'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomprenomprecconjoint' => new sfWidgetFormFilterInput(),
      'nomapresmariage'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mariage_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mariage'), 'column' => 'id')),
      'nom'                   => new sfValidatorPass(array('required' => false)),
      'prenom'                => new sfValidatorPass(array('required' => false)),
      'sexe'                  => new sfValidatorPass(array('required' => false)),
      'typeacteur'            => new sfValidatorPass(array('required' => false)),
      'datenaissance'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieunaissance'         => new sfValidatorPass(array('required' => false)),
      'domicile'              => new sfValidatorPass(array('required' => false)),
      'residence'             => new sfValidatorPass(array('required' => false)),
      'profession'            => new sfValidatorPass(array('required' => false)),
      'etatanterieurmariage'  => new sfValidatorPass(array('required' => false)),
      'nomprenomprecconjoint' => new sfValidatorPass(array('required' => false)),
      'nomapresmariage'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_acteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MariageActeur';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'mariage_id'            => 'ForeignKey',
      'nom'                   => 'Text',
      'prenom'                => 'Text',
      'sexe'                  => 'Text',
      'typeacteur'            => 'Text',
      'datenaissance'         => 'Date',
      'lieunaissance'         => 'Text',
      'domicile'              => 'Text',
      'residence'             => 'Text',
      'profession'            => 'Text',
      'etatanterieurmariage'  => 'Text',
      'nomprenomprecconjoint' => 'Text',
      'nomapresmariage'       => 'Text',
    );
  }
}
