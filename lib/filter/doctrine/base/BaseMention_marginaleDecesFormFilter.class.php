<?php

/**
 * Mention_marginaleDeces filter form base class.
 *
 * @package    etatcivil
 * @subpackage filter
 * @author     Boyer Jimmy
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMention_marginaleDecesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'deces_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Deces'), 'add_empty' => true)),
      'mention'   => new sfWidgetFormFilterInput(),
      'dateAjout' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'deces_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Deces'), 'column' => 'id')),
      'mention'   => new sfValidatorPass(array('required' => false)),
      'dateAjout' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('mention_marginale_deces_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mention_marginaleDeces';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'deces_id'  => 'ForeignKey',
      'mention'   => 'Text',
      'dateAjout' => 'Date',
    );
  }
}
