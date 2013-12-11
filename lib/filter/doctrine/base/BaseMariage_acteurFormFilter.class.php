<?php

/**
 * Mariage_acteur filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMariage_acteurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mariage_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nom'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'                  => new sfWidgetFormChoice(array('choices' => array('' => '', 'homme' => 'homme', 'femme' => 'femme'))),
      'typeActeur'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'dateNaissance'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lieuNaissance'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicile'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'residence'             => new sfWidgetFormFilterInput(),
      'profession'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'etatAnterieurMariage'  => new sfWidgetFormChoice(array('choices' => array('' => '', 'célibataire' => 'célibataire', 'veuf(ve)' => 'veuf(ve)', 'divorcé(e)' => 'divorcé(e)'))),
      'nomPrenomPrecConjoint' => new sfWidgetFormFilterInput(),
      'nomApresMariage'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mariage_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mariage'), 'column' => 'id')),
      'nom'                   => new sfValidatorPass(array('required' => false)),
      'prenom'                => new sfValidatorPass(array('required' => false)),
      'sexe'                  => new sfValidatorChoice(array('required' => false, 'choices' => array('homme' => 'homme', 'femme' => 'femme'))),
      'typeActeur'            => new sfValidatorChoice(array('required' => false, 'choices' => array('conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'dateNaissance'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'lieuNaissance'         => new sfValidatorPass(array('required' => false)),
      'domicile'              => new sfValidatorPass(array('required' => false)),
      'residence'             => new sfValidatorPass(array('required' => false)),
      'profession'            => new sfValidatorPass(array('required' => false)),
      'etatAnterieurMariage'  => new sfValidatorChoice(array('required' => false, 'choices' => array('célibataire' => 'célibataire', 'veuf(ve)' => 'veuf(ve)', 'divorcé(e)' => 'divorcé(e)'))),
      'nomPrenomPrecConjoint' => new sfValidatorPass(array('required' => false)),
      'nomApresMariage'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_acteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage_acteur';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'mariage_id'            => 'ForeignKey',
      'nom'                   => 'Text',
      'prenom'                => 'Text',
      'sexe'                  => 'Enum',
      'typeActeur'            => 'Enum',
      'dateNaissance'         => 'Date',
      'lieuNaissance'         => 'Text',
      'domicile'              => 'Text',
      'residence'             => 'Text',
      'profession'            => 'Text',
      'etatAnterieurMariage'  => 'Enum',
      'nomPrenomPrecConjoint' => 'Text',
      'nomApresMariage'       => 'Text',
    );
  }
}
