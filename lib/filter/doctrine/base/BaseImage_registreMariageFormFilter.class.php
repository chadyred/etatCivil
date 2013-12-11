<?php

/**
 * Image_registreMariage filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseImage_registreMariageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mariage_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mariage'), 'add_empty' => true)),
      'nomImage'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mariage_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mariage'), 'column' => 'id')),
      'nomImage'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('image_registre_mariage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image_registreMariage';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'mariage_id' => 'ForeignKey',
      'nomImage'   => 'Text',
    );
  }
}
