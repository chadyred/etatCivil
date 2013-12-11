<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginFormclass
 *
 * @author Boyer Jimmy
 */
class LoginForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'Identifiant' => new sfWidgetFormInput(),
      'Mot de passe' => new sfWidgetFormInputPassword()
    ));

    $this->widgetSchema->setNameFormat('login[%s]');

    $this->setValidators(array(
      'Identifiant' => new sfValidatorString(array('required' => true)),
      'Mot de passe' => new sfValidatorString(array('required' => true))
    ));

    $this->validatorSchema['Mot de passe'] = new sfValidatorString();
  }
}
?>
