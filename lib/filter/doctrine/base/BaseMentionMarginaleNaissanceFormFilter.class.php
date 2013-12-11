<?php

/**
 * MentionMarginaleNaissance filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMentionMarginaleNaissanceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naissance_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naissance'), 'add_empty' => true)),
      'mention'      => new sfWidgetFormFilterInput(),
      'dateajout'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'naissance_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naissance'), 'column' => 'id')),
      'mention'      => new sfValidatorPass(array('required' => false)),
      'dateajout'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('mention_marginale_naissance_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MentionMarginaleNaissance';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'naissance_id' => 'ForeignKey',
      'mention'      => 'Text',
      'dateajout'    => 'Date',
    );
  }
}
