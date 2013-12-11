<?php

/**
 * Mariage_acteur form base class.
 *
 * @method Mariage_acteur getObject() Returns the current form's model object
 *
 * @package    etatcivil
 * @subpackage form
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMariage_acteurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'mariage_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => false)),
      'nom'                   => new sfWidgetFormInputText(),
      'prenom'                => new sfWidgetFormInputText(),
      'sexe'                  => new sfWidgetFormChoice(array('choices' => array('homme' => 'homme', 'femme' => 'femme'))),
      'typeActeur'            => new sfWidgetFormChoice(array('choices' => array('conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'dateNaissance'         => new sfWidgetFormDate(),
      'lieuNaissance'         => new sfWidgetFormTextarea(),
      'domicile'              => new sfWidgetFormTextarea(),
      'residence'             => new sfWidgetFormTextarea(),
      'profession'            => new sfWidgetFormInputText(),
      'etatAnterieurMariage'  => new sfWidgetFormChoice(array('choices' => array('célibataire' => 'célibataire', 'veuf(ve)' => 'veuf(ve)', 'divorcé(e)' => 'divorcé(e)'))),
      'nomPrenomPrecConjoint' => new sfWidgetFormInputText(),
      'nomApresMariage'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mariage_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'))),
      'nom'                   => new sfValidatorString(array('max_length' => 60)),
      'prenom'                => new sfValidatorString(array('max_length' => 60)),
      'sexe'                  => new sfValidatorChoice(array('choices' => array(0 => 'homme', 1 => 'femme'), 'required' => false)),
      'typeActeur'            => new sfValidatorChoice(array('choices' => array(0 => 'conjoint1', 1 => 'conjoint2'), 'required' => false)),
      'dateNaissance'         => new sfValidatorDate(),
      'lieuNaissance'         => new sfValidatorString(array('max_length' => 4000)),
      'domicile'              => new sfValidatorString(array('max_length' => 4000)),
      'residence'             => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'profession'            => new sfValidatorString(array('max_length' => 70)),
      'etatAnterieurMariage'  => new sfValidatorChoice(array('choices' => array(0 => 'célibataire', 1 => 'veuf(ve)', 2 => 'divorcé(e)'), 'required' => false)),
      'nomPrenomPrecConjoint' => new sfValidatorString(array('max_length' => 90, 'required' => false)),
      'nomApresMariage'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_acteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage_acteur';
  }

}
