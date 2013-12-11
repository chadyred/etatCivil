<?php

/**
 * Ville_france filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVille_franceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'CP'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Ville'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Region'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Departement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'Pays'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'CP'          => new sfValidatorPass(array('required' => false)),
      'Ville'       => new sfValidatorPass(array('required' => false)),
      'Region'      => new sfValidatorPass(array('required' => false)),
      'Departement' => new sfValidatorPass(array('required' => false)),
      'Pays'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ville_france_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ville_france';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'CP'          => 'Text',
      'Ville'       => 'Text',
      'Region'      => 'Text',
      'Departement' => 'Text',
      'Pays'        => 'Text',
    );
  }
}
