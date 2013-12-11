<?php

/**
 * Mariage_contact form.
 *
 * @package    etatCivil
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class Mariage_contactForm extends BaseMariage_contactForm
{
  public function configure()
  {

      $this->widgetSchema['mariage_id'] =
              new sfWidgetFormInputHidden();
      $this->widgetSchema['typeContact'] =
              new sfWidgetFormInputHidden();
      $this->widgetSchema['enRelationA'] =
              new sfWidgetFormInputHidden();
  }
}
