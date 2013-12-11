<?php

/**
 * mariage_contact actions.
 *
 * @package    etatCivil
 * @subpackage mariage_contact
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mariage_contactActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->mariage_contacts = Doctrine_Core::getTable('Mariage_contact')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mariage_contact = Doctrine_Core::getTable('Mariage_contact')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mariage_contact);
  }


  // permet l'affichage des acteurs propre a un mariage
  public function executeShowTemoinsByMariage(sfWebRequest $request)
  {
    $this->mariage_contacts = Doctrine_Core::getTable('Mariage_contact')
      ->createQuery('a')
      ->where('a.mariage_id=?', $request->getParameter('mariage_id'))
      ->andWhere('a.typeContact=?', "témoin")
      ->execute();

    $this->typeContact = "témoins";

    $this->setTemplate('index');
  }

    // permet l'affichage des acteurs propre a un mariage
  public function executeShowParentsByMariage(sfWebRequest $request)
  {
    $this->mariage_contacts = Doctrine_Core::getTable('Mariage_contact')
      ->createQuery('a')
      ->where('a.mariage_id=?', $request->getParameter('mariage_id'))
      ->andWhere('a.typeContact=?', "père")
      ->orWhere('a.mariage_id=?', $request->getParameter('mariage_id'))
      ->andWhere('a.typeContact=?', "mère")
      ->execute();

    $this->typeContact = "parents";

    $this->setTemplate('index');
  }

  public function executeNewPereEpoux(sfWebRequest $request)
  {
    $this->contact = "du père de l'conjoint 1";
    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "père");
    $this->form->setDefault("enRelationA", "conjoint1");
  
    $this->setTemplate("new");
  }

  public function executeNewMereEpoux(sfWebRequest $request)
  {
    $this->contact = "de la mère de l'conjoint 1";
    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "mère");
    $this->form->setDefault("enRelationA", "conjoint1");

    $this->setTemplate("new");

  }

  public function executeNewPereEpouse(sfWebRequest $request)
  {
    $this->contact = "du père de l'conjoint 2";
    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "père");
    $this->form->setDefault("enRelationA", "conjoint2");

    $this->setTemplate("new");
  }

  public function executeNewMereEpouse(sfWebRequest $request)
  {
    $this->contact = "de la mère de l'conjoint 2";
    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "mère");
    $this->form->setDefault("enRelationA", "conjoint2");

    $this->setTemplate("new");

  }

  public function executeNewTemoinEpoux(sfWebRequest $request)
  {

    $this->contact = "d'un témoin pour l'conjoint 1";

    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "témoin");
    $this->form->setDefault("enRelationA", "conjoint1");

    $this->setTemplate("new");

  }

  public function executeNewTemoinEpouse(sfWebRequest $request)
  {
    $this->contact = "d'un témoin pour l'conjoint 2";
    $this->form = new Mariage_contactForm();

    $this->form->setDefault("mariage_id", $request->getParameter("mariage_id"));
    $this->form->setDefault("typeContact", "témoin");
    $this->form->setDefault("enRelationA", "conjoint2");

    $this->setTemplate("new");
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Mariage_contactForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mariage_contact = Doctrine_Core::getTable('Mariage_contact')->find(array($request->getParameter('id'))), sprintf('Object mariage_contact does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mariage_contactForm($mariage_contact);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mariage_contact = Doctrine_Core::getTable('Mariage_contact')->find(array($request->getParameter('id'))), sprintf('Object mariage_contact does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mariage_contactForm($mariage_contact);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mariage_contact = Doctrine_Core::getTable('Mariage_contact')->find(array($request->getParameter('id'))), sprintf('Object mariage_contact does not exist (%s).', $request->getParameter('id')));

    $mariage_contact->delete();

    $this->redirect('mariage/show?id='.$request->getParameter('mariage_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
     $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mariage_contact = $form->save();

      //$this->redirect('mariage_contact/edit?id='.$mariage_contact->getId());

     $this->redirect('mariage_acteur/show?id='.$mariage_contact->getActeur_id());
    }
  }
}
