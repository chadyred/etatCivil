<?php

/**
 * naissance_enfant actions.
 *
 * @package    etatCivil
 * @subpackage naissance_enfant
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class naissance_enfantActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->naissance_enfants = Doctrine_Core::getTable('Naissance_enfant')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    
    $this->naissance_enfants = Doctrine_Core::getTable('Naissance_enfant')
      ->createQuery('n')
      ->where('n.naissance_id=?', $request->getParameter('id'))
      ->execute();

    $this->naissance_enfant = $this->naissance_enfants->getFirst();

    $this->forward404Unless($this->naissance_enfant);
  }


  // permet l'affichage de l'enfant de l'acte
  public function executeShowByNaissance(sfWebRequest $request)
  {
    $this->naissance_enfants = Doctrine_Core::getTable('Naissance_enfant')
      ->createQuery('a')
      ->where('a.naissance_id=?', $request->getParameter('id'))
      ->execute();

    $this->naissanceEnf = $this->getRoute()->getObject();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new Naissance_enfantForm();

    $this->form->setDefault('naissance_id', $request->getParameter('id'));

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new Naissance_enfantForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($naissance_enfant = Doctrine_Core::getTable('Naissance_enfant')->find(array($request->getParameter('id'))), sprintf('Object naissance_enfant does not exist (%s).', $request->getParameter('id')));
    $this->form = new Naissance_enfantForm($naissance_enfant);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($naissance_enfant = Doctrine_Core::getTable('Naissance_enfant')->find(array($request->getParameter('id'))), sprintf('Object naissance_enfant does not exist (%s).', $request->getParameter('id')));
    $this->form = new Naissance_enfantForm($naissance_enfant);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($naissance_enfant = Doctrine_Core::getTable('Naissance_enfant')->find(array($request->getParameter('id'))), sprintf('Object naissance_enfant does not exist (%s).', $request->getParameter('id')));
    $naissance_enfant->delete();

    $this->redirect('naissance/show?id='.$request->getParameter('naissance_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $naissance_enfant = $form->save();

      $this->redirect('naissance/show?id='.$naissance_enfant->getNaissanceId());
    }
  }
}
