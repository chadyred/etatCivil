<?php
/**
 * Cette classe permet la création du formulaire de recherche
 * sur les actes de Deces
 *
 * @author Boyer Jimmy
 */
class SearchDecesForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'Nom Defunt' => new sfWidgetFormInput(),
      'Prenom Defunt' => new sfWidgetFormInput(),
      'Date Acte' => new sfWidgetFormDate(),
      'Id Acte' => new sfWidgetFormInput(),
      'TypeActe' => new sfWidgetFormChoice(array('choices' => array('décès' => 'décès', 'transcription' => 'transcription'))),
      'DateTranscription'    => new sfWidgetFormDate(),
    ));

    $this->widgetSchema->setNameFormat('Recherche[%s]');

    $this->setValidators(array(
      'Nom Defunt' => new sfValidatorString(),
      'Prenom Defunt' => new sfValidatorString(),
      'Date Acte' => new sfValidatorDate(),
      'Id Acte' => new sfValidatorInteger(),
      'TypeActe' => new sfValidatorChoice(array('choices' => array(0 => 'décès', 1 => 'transcription'), 'required' => false)),
      'DateTranscription' => new sfValidatorDate()
    ));

    $this->validatorSchema['Prenom Defunt'] = new sfValidatorString();


    $range = range('1903', date('Y')+2);


    $widgetDate = $this->widgetSchema['Date Acte'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
    ));

    $widgetDate2 = $this->widgetSchema['DateTranscription'] =
              new sfWidgetFormJQueryDate(array(
                                                'image'=>'/images/calendar.png',
                                                'culture' => 'fr',
                                                'date_widget' => new sfWidgetFormDate(array(
                                                    'format' => '%day%/%month%/%year%',
                                                    'years' => array_combine($range, $range) ))
    ));


    parent::setup();
  }
}
?>
