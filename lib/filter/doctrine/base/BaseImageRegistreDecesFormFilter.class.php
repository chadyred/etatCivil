<?php

/**
 * ImageRegistreDeces filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImageRegistreDecesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'deces_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Deces'), 'add_empty' => true)),
      'nomimage' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'deces_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Deces'), 'column' => 'id')),
      'nomimage' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_registre_deces_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ImageRegistreDeces';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'deces_id' => 'ForeignKey',
      'nomimage' => 'Text',
    );
  }
}
