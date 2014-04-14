<?php

/**
 * MariageContact filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMariageContactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mariage_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nom'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sexe'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'typecontact' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'enrelationa' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'info'        => new sfWidgetFormFilterInput(),
      'age'         => new sfWidgetFormFilterInput(),
      'domicile'    => new sfWidgetFormFilterInput(),
      'profession'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mariage_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mariage'), 'column' => 'id')),
      'nom'         => new sfValidatorPass(array('required' => false)),
      'prenom'      => new sfValidatorPass(array('required' => false)),
      'sexe'        => new sfValidatorPass(array('required' => false)),
      'typecontact' => new sfValidatorPass(array('required' => false)),
      'enrelationa' => new sfValidatorPass(array('required' => false)),
      'info'        => new sfValidatorPass(array('required' => false)),
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
    return 'MariageContact';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'mariage_id'  => 'ForeignKey',
      'nom'         => 'Text',
      'prenom'      => 'Text',
      'sexe'        => 'Text',
      'typecontact' => 'Text',
      'enrelationa' => 'Text',
      'info'        => 'Text',
      'age'         => 'Number',
      'domicile'    => 'Text',
      'profession'  => 'Text',
    );
  }
}
