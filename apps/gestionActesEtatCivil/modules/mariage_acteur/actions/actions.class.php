<?php

/**
 * mariage_acteur actions.
 *
 * @package    etatCivil
 * @subpackage mariage_acteur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mariage_acteurActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

    $this->mariage_acteurs = Doctrine_Core::getTable('Mariage_acteur')
      ->createQuery('a')
      ->execute();
  }

  // Permet de récupéré l'acteur et de l'afficher
  public function executeShow(sfWebRequest $request)
  {
    $this->mariage_acteur = Doctrine_Core::getTable('Mariage_acteur')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mariage_acteur);
  }

  // permet l'affichage des acteurs propre a un mariage
  public function executeShowByMariage(sfWebRequest $request)
  {
    $this->mariage_acteurs = Doctrine_Core::getTable('Mariage_acteur')
      ->createQuery('a')
      ->where('a.mariage_id=?', $request->getParameter('mariage_id'))
      ->execute();

    $this->setTemplate('index');
  }

  public function executeNewEpoux(sfWebRequest $request)
  {

    $this->form = new Mariage_acteurForm();

    // Cette commande permet de definir la relation entre le mariage et l'acteur automatiquement
    $this->form->setDefault('mariage_id', $request->getParameter("mariage_id"));
    $this->form->setDefault('typeActeur', "conjoint1");
    
    $this->setTemplate('new');
  }

  public function executeNewEpouse(sfWebRequest $request)
  {      
      
 
    $this->form = new Mariage_acteurForm();

    // Cette commande permet de definir la relation entre le mariage et l'acteur automatiquement
    $this->form->setDefault('mariage_id', $request->getParameter("mariage_id"));
    $this->form->setDefault('typeActeur', "conjoint2");

    $this->setTemplate('new');
  }

  public function executeCreate(sfWebRequest $request)
  {
    
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Mariage_acteurForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mariage_acteur = Doctrine_Core::getTable('Mariage_acteur')->find(array($request->getParameter('id'))), sprintf('Object mariage_acteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mariage_acteurForm($mariage_acteur);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mariage_acteur = Doctrine_Core::getTable('Mariage_acteur')->find(array($request->getParameter('id'))), sprintf('Object mariage_acteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new Mariage_acteurForm($mariage_acteur);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mariage_acteur = Doctrine_Core::getTable('Mariage_acteur')->find(array($request->getParameter('id'))), sprintf('Object mariage_acteur does not exist (%s).', $request->getParameter('id')));
    $mariage_acteur->delete();


    $this->redirect('mariage/show?id='.$request->getParameter('mariage_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
      
    
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mariage_acteur = $form->save();

    //  $this->redirect('mariage_acteur/edit?id='.$mariage_acteur->getId());
    
      $this->redirect('mariage_acteur/show?id='.$mariage_acteur->getId());
    }
  }
}
