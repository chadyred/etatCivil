<?php

/**
 * naissance_acteur actions.
 *
 * @package    etatCivil
 * @subpackage naissance_acteur
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class naissance_acteurActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->naissance_acteurs = Doctrine_Core::getTable('Naissance_acteur')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->naissance_acteur = Doctrine_Core::getTable('Naissance_acteur')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->naissance_acteur);
  }

  // permet l'affichage de(s) déclarants de l'acte
  public function executeShowByNaissance(sfWebRequest $request)
  {
    $this->naissance_acteurs = Doctrine_Core::getTable('Naissance_acteur')
      ->createQuery('a')
      ->where('a.naissance_id=?', $request->getParameter('id'))
      ->execute();

    $this->setTemplate('index');
  }


  public function executeNewPere(sfWebRequest $request)
  {
    $this->form = new Naissance_acteurForm();

    $this->form->setDefault('naissance_id', $request->getParameter('id'));
    $this->form->setDefault('typeActeur', "père");
    $this->form->setDefault('sexe', "masculin");

    $this->setTemplate('new');
  }

  public function executeNewMere(sfWebRequest $request)
  {
    $this->form = new Naissance_acteurForm();

    $this->form->setDefault('naissance_id', $request->getParameter('id'));
    $this->form->setDefault('typeActeur', "mère");
    $this->form->setDefault('sexe', "feminin");

    $this->setTemplate('new');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Naissance_acteurForm();

    $this->form->setDefault('naissance_id', $request->getParameter('id'));
    $this->form->setDefault('typeActeur', "autre préciser...");

    $this->setTemplate('new');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Naissance_acteurForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($naissance_acteur = Doctrine_Core::getTable('Naissance_acteur')->find(array($request->getParameter('id'))), sprintf('Object naissance_acteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new Naissance_acteurForm($naissance_acteur);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($naissance_acteur = Doctrine_Core::getTable('Naissance_acteur')->find(array($request->getParameter('id'))), sprintf('Object naissance_acteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new Naissance_acteurForm($naissance_acteur);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($naissance_acteur = Doctrine_Core::getTable('Naissance_acteur')->find(array($request->getParameter('id'))), sprintf('Object naissance_acteur does not exist (%s).', $request->getParameter('id')));
    $naissance_acteur->delete();

    $this->redirect('naissance/show?id='.$request->getParameter('naissance_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $naissance_acteur = $form->save();

      $this->redirect('naissance/show?id='.$naissance_acteur->getNaissanceId());
    }
  }
}
