<?php

/**
 * Mariage_contact filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMariage_contactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mariage_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nom'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'masculin' => 'masculin', 'féminin' => 'féminin'))),
      'typeContact' => new sfWidgetFormChoice(array('choices' => array('' => '', 'témoin' => 'témoin', 'père' => 'père', 'mère' => 'mère'))),
      'enRelationA' => new sfWidgetFormChoice(array('choices' => array('' => '', 'conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'info'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'décédé(e)' => 'décédé(e)'))),
      'age'         => new sfWidgetFormFilterInput(),
      'domicile'    => new sfWidgetFormFilterInput(),
      'profession'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mariage_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mariage'), 'column' => 'id')),
      'nom'         => new sfValidatorPass(array('required' => false)),
      'prenom'      => new sfValidatorPass(array('required' => false)),
      'sexe'        => new sfValidatorChoice(array('required' => false, 'choices' => array('masculin' => 'masculin', 'féminin' => 'féminin'))),
      'typeContact' => new sfValidatorChoice(array('required' => false, 'choices' => array('témoin' => 'témoin', 'père' => 'père', 'mère' => 'mère'))),
      'enRelationA' => new sfValidatorChoice(array('required' => false, 'choices' => array('conjoint1' => 'conjoint1', 'conjoint2' => 'conjoint2'))),
      'info'        => new sfValidatorChoice(array('required' => false, 'choices' => array('' => '', 'décédé(e)' => 'décédé(e)'))),
      'age'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'domicile'    => new sfValidatorPass(array('required' => false)),
      'profession'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mariage_contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mariage_contact';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'mariage_id'  => 'ForeignKey',
      'nom'         => 'Text',
      'prenom'      => 'Text',
      'sexe'        => 'Enum',
      'typeContact' => 'Enum',
      'enRelationA' => 'Enum',
      'info'        => 'Enum',
      'age'         => 'Number',
      'domicile'    => 'Text',
      'profession'  => 'Text',
    );
  }
}
