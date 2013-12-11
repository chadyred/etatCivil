<?php

/**
 * naissance actions.
 *
 * @package    etatCivil
 * @subpackage naissance
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class naissanceActions extends sfActions
{
  /**
   * Cette fonction execute la requête permettant d'afficher
   * tous les actes de naissance enregistrés.
   * Pour que le temps de réponse de la page soit optimisé, une pagination est
   * utilisée et permet d'afficher les résultats par 20.
   * 
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()
    ->from('Naissance n')
          ->orderBy("n.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Naissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

  }

   /**
   * Cette fonction execute la requête permettant d'afficher
   * le détails d'un acte de naissance.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->naissance = Doctrine_Core::getTable('Naissance')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->naissance);
  }

   /**
   * Cette fonction execute la requête permettant d'afficher
   * le formulaire de saisie d'un nouvel acte
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new NaissanceForm();
  }

   /**
   * Cette fonction execute la requête permettant d'afficher
   * le formulaire de saisie d'un nouvel acte
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NaissanceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

   /**
   * Cette fonction execute la requête permettant d'entré en édition
   * sur le formulaire de l'acte
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($naissance = Doctrine_Core::getTable('Naissance')->find(array($request->getParameter('id'))), sprintf('Object naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new NaissanceForm($naissance);
  }

   /**
   * Cette fonction execute la requête permettant de mettre a jour
   * les informations d'un acte modifié dans le formulaire d'édition
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($naissance = Doctrine_Core::getTable('Naissance')->find(array($request->getParameter('id'))), sprintf('Object naissance does not exist (%s).', $request->getParameter('id')));
    $this->form = new NaissanceForm($naissance);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

   /**
   * Cette fonction execute la requête permettant de supprimer
   * un acte de naissance
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($naissance = Doctrine_Core::getTable('Naissance')->find(array($request->getParameter('id'))), sprintf('Object naissance does not exist (%s).', $request->getParameter('id')));
    $naissance->delete();

    $this->getUser()->setFlash('notice', sprintf('Suppression effectuée avec succès'));

    $this->redirect('naissance/index');
  }

      /**
   * @version 1.0
   *
   *  fonction permet de rechercher l'acte de naissance depuis les formulaires
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeSearch(sfWebRequest $request)
  {
      // Création et affichage de notre formulaire de recherche
      $this->form = new SearchNaissanceForm();
  }


  /**
   * Cette fonction permet d'afficher la liste des résultats de la recherche
   * Elle gere une pagination en conservant la requete de la recherche
   * dans un attribut flash de l'utilisateur "sf_user"
   *
   * @author Boyer jimmy
   * @param sfWebRequest $request
   */
  public function executeResult(sfWebRequest $request)
  {
      // Pour que l'affichage des resultats soit correct, il faut stocker
      // les informations saisies dans le formulaire de recherche.

      // Pour cela on test si la requete demande une pagination
      if(!$request->hasParameter("page"))
      {
        // Si non, on recupère le parametre envoyer par le formulaire
        $recherche = $request->getParameter("Recherche");
        // et on stock ce parametre dans un attribut flash de l'utilisateur
        $this->getUser()->setAttribute('RechercheC', $recherche);
      } else {
        // Si une pagination est demander, cela signifi que l'affichage des premiers
        // résultats à déja été effectuer, et que la requete ne contien plus nos infos
        // du formulaire de recherche. On les récupère donc dans l'attribut flash stocker dans notre user.
        $recherche = $this->getUser()->getAttribute('RechercheC');
      }

      /*
      * C'est ici que l'on construit la requete SQL permettant la recherche multi-critere
      * Elle s'appui sur le requetage SQL ==> LIKE %VALUE%
      * Pour rajouter un champs il suffira d'ajouter un élement dans le
      * formulaire de recherche ( SearchMariageForm ) Puis d'ajouter une ligne
      * "andWhere" similaire a celles ci dessous
      */
      $q = Doctrine_Query::create()
        ->select('DISTINCT *')
        ->from("naissance n")
        ->leftJoin("naissance_enfant n2 on n.id = n2.naissance_id")
        ->where("n.id = n2.naissance_id")
        ->andwhere("n.id LIKE ?"                        , "%".$recherche["Id Acte"]."%")
        ->andWhere("YEAR(n.dateActe) LIKE ?"            , "%".$recherche["Date Acte"]["year"]."%")
        ->andWhere("MONTH(n.dateActe) LIKE ?"           , "%".$recherche["Date Acte"]["month"]."%")
        ->andWhere("DAY(n.dateActe) LIKE ?"             , "%".$recherche["Date Acte"]["day"]."%")
        ->andWhere("n2.prenom LIKE ?"                   , "%".$recherche["Prenom Enfant"]."%")
        ->andWhere("n2.nom LIKE ?"                      , "%".$recherche["Nom Enfant"]."%")
        ->andWhere("YEAR(n2.dateNaissance) LIKE ?"           , "%".$recherche["Date Naissance"]["year"]."%")
        ->andWhere("MONTH(n2.dateNaissance) LIKE ?"          , "%".$recherche["Date Naissance"]["month"]."%")
        ->andWhere("DAY(n2.dateNaissance) LIKE ?"            , "%".$recherche["Date Naissance"]["day"]."%");


     

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);
    // on conserve la recherche
    $this->RechercheC = $recherche;
    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);
    // On demande a notre plugin d'afficher nbResult résultats par page
    $this->pager = new sfDoctrinePager('Naissance', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    // On stock dans une variable ( ci besoin ) le nombre de de résultats total
    $this->lastId = $q->count();
  }



   /**
   * Cette fonction execute la requête permettant d'enregistrer
   * les informations du formulaire d'un nouvel acte
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $naissance = $form->save();

      $this->getUser()->setFlash('notice', sprintf('Modifications effectuées avec succès'));

      $this->redirect('naissance/show?id='.$naissance->getId());
    }
  }

   /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de Naissance. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeNaissance(sfWebRequest $request)
  {

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());

    $doc->mergeXmlField('PrenomNomEnfant', $enfant->getPrenom()." ".$enfant->getNom());

    $doc->mergeXmlField('nomEnfant', $enfant->getNom());
    $doc->mergeXmlField('prenomEnfant', $enfant->getPrenom());
    $doc->mergeXmlField('sexe', $enfant->getSexe());

    $datenaissanceEnfant = $this->getDateEnLettre(strtotime($enfant->getDateNaissance()), 1);

    $doc->mergeXmlField('dateLettreNaissanceEnfant', $datenaissanceEnfant);

    $heureNaissanceEnfant = $this->getHeureEnLettre($enfant->getHeureNaissance(), 1);

    $doc->mergeXmlField('heureNaissanceLettre', $heureNaissanceEnfant);
    $doc->mergeXmlField('lieuNaissance', Ville_france::getVilleCP($enfant->getLieuNaissance()));

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
        $doc->mergeXmlField('dateNaissancePere', $this->getDateEnLettre(strtotime($pere->getDateNaissance()), 0 ));
        $doc->mergeXmlField('lieuNaissancePere', Ville_france::getVilleCP(Ville_france::getVilleCP($pere->getLieuNaissance())));
        $doc->mergeXmlField('professionPere', $pere->getProfession());
        $doc->mergeXmlField('domicilePere', $pere->getDomicile());
    }

    //--------------------------------------------------------------------------
    // Ssi la Mere est renseignée on complete les informations
    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
        $doc->mergeXmlField('dateNaissanceMere', $this->getDateEnLettre(strtotime($mere->getDateNaissance()), 0));
        $doc->mergeXmlField('lieuNaissanceMere', Ville_france::getVilleCP($mere->getLieuNaissance()));
        $doc->mergeXmlField('professionMere', $mere->getProfession());
        $doc->mergeXmlField('domicileMere', $mere->getDomicile());
    }

    $madate = (int)$naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 0);
    $dateLettre = $this->getDateEnLettre(strtotime($madate), 1);

    //--------------------------------------------------------------------------
    // Si il y a une date de reconnaissance, on le renseigne
    if ($naissance->getDateReconnaissance() != null)
    {
        $doc->mergeXmlField('dateReconnaissance', $this->getDateEnLettre(strtotime($naissance->getDateReconnaissance()), 1));
    } else $doc->mergeXmlField('dateReconnaissance', "/");

    //--------------------------------------------------------------------------
    // Si il y a un lieu de reconnaissance on le renseigne
    if ($naissance->getLieuReconnaissance())
        $doc->mergeXmlField('lieuReconnaissance', $naissance->getLieuReconnaissance());
    else $doc->mergeXmlField('lieuReconnaissance', "/");

    //--------------------------------------------------------------------------
    // Si les parents sont mariés on affiche les infos
    if ($enfant->getDateMariageParents() != null)
        $doc->mergeXmlField('mariageParents',  "Le ".$enfant->getDateMariageParents()
                                                    ." à ".
                                                    $enfant->getLieuMariageParents());
    else $doc->mergeXmlField('mariageParents', "/");

    //--------------------------------------------------------------------------
    // On renseigne les infos des déclarants de l'acte
    $doc->mergeXmlField('infoDeclarant', $this->getInfosDeclarants($naissance));

    //--------------------------------------------------------------------------
    // On renseigne la date de l'acte
    $doc->mergeXmlField('dateActe', $dateNorm );
    $doc->mergeXmlField('heureActe', $this->getHeureEnLettre($naissance->getHeureActe(), 0));

    //--------------------------------------------------------------------------
    // on renseigne les infos de l'officier d'Etat Civil qui saisi l'acte
    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_naissance_".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
  }


  /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de Naissance. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executePlurilinguesNaissance(sfWebRequest $request)
  {
    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());


    $doc->mergeXmlField('nomEnfant', $enfant->getNom());
    $doc->mergeXmlField('prenomEnfant', $enfant->getPrenom());
    $doc->mergeXmlField('sexe', $enfant->getSexe());

    $datenaissanceEnfant = $this->getDateEnLettre(strtotime($enfant->getDateNaissance()), 2);

    $doc->mergeXmlField('dateNaissanceF', $datenaissanceEnfant);

    $heureNaissanceEnfant = $this->getHeureEnLettre($enfant->getHeureNaissance(), 1);

    $doc->mergeXmlField('lieuNaissance', Ville_france::getVilleCP($enfant->getLieuNaissance()));

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
    } else
    {
        $doc->mergeXmlField('nomPere', "non renseigné");
        $doc->mergeXmlField('prenomPere', "non renseigné");
    }

    //--------------------------------------------------------------------------
    // Ssi la Mere est renseignée on complete les informations
    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
    } else
    {
        $doc->mergeXmlField('nomMere', "non renseigné");
        $doc->mergeXmlField('prenomMere', "non renseigné");
    }

    $madate = $naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 2);


    //--------------------------------------------------------------------------
    // On renseigne la date de l'acte
    $doc->mergeXmlField('dateActeF', $dateNorm );

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_naissance_".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de Naissance. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisChgtNom(sfWebRequest $request)
  {
    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());


    $doc->mergeXmlField('nomEnfant', $enfant->getNom());
    $doc->mergeXmlField('prenomEnfant', $enfant->getPrenom());
    $doc->mergeXmlField('sexe', $enfant->getSexe());

    $datenaissanceEnfant = $this->getDateEnLettre(strtotime($enfant->getDateNaissance()), 2);

    $doc->mergeXmlField('dateNaissanceF', $datenaissanceEnfant);

    $heureNaissanceEnfant = $this->getHeureEnLettre($enfant->getHeureNaissance(), 1);

    $doc->mergeXmlField('lieuNaissance', Ville_france::getVilleCP($enfant->getLieuNaissance()));

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
    } else
    {
        $doc->mergeXmlField('nomPere', "non renseigné");
        $doc->mergeXmlField('prenomPere', "non renseigné");
    }

    //--------------------------------------------------------------------------
    // Ssi la Mere est renseignée on complete les informations
    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
    } else
    {
        $doc->mergeXmlField('nomMere', "non renseigné");
        $doc->mergeXmlField('prenomMere', "non renseigné");
    }

    $madate = $naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 2);


    //--------------------------------------------------------------------------
    // On renseigne la date de l'acte
    $doc->mergeXmlField('dateActeF', $dateNorm );

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_naissance_".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de Naissance. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisReconnaissancePost(sfWebRequest $request)
  {
    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());


    $doc->mergeXmlField('nomEnfant', $enfant->getNom());
    $doc->mergeXmlField('prenomEnfant', $enfant->getPrenom());

    $datenaissanceEnfant = $this->getDateEnLettre(strtotime($enfant->getDateNaissance()), 2);

    $doc->mergeXmlField('dateNEnfant', $datenaissanceEnfant);

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
        $doc->mergeXmlField('dateNPere', $this->getDateEnLettre(strtotime($pere->getDateNaissance()), 0));
        $doc->mergeXmlField('lieuNPere', $pere->getLieuNaissance());
    } else
    {
        $doc->mergeXmlField('nomPere', "non renseigné");
        $doc->mergeXmlField('prenomPere', "non renseigné");
        $doc->mergeXmlField('dateNPere', "non renseigné");
        $doc->mergeXmlField('lieuNPere', "non renseigné");
    }

    $madate = $naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 2);


    //--------------------------------------------------------------------------
    // On renseigne la date de l'acte
    $doc->mergeXmlField('dateActe', $dateNorm );

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_naissance_".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
  }
  
  /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de Naissance. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeLivretModele(sfWebRequest $request)
  {
    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
        $doc->mergeXmlField('dateNaissanceP', $this->getDateEnLettre(strtotime($pere->getDateNaissance()),0));
        $doc->mergeXmlField('lieuNaissanceP', $pere->getLieuNaissance());
    } else
    {
        $doc->mergeXmlField('nomPere', "non renseigné");
        $doc->mergeXmlField('prenomPere', "non renseigné");
        $doc->mergeXmlField('dateNaissanceP', "non renseigné");
        $doc->mergeXmlField('lieuNaissanceP', "non renseigné");
    }

    //--------------------------------------------------------------------------
    // Ssi la Mere est renseignée on complete les informations
    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
        $doc->mergeXmlField('dateNaissanceM', $this->getDateEnLettre(strtotime($mere->getDateNaissance()),2));
        $doc->mergeXmlField('lieuNaissanceM', $mere->getLieuNaissance());
    } else
    {
        $doc->mergeXmlField('nomMere', "non renseigné");
        $doc->mergeXmlField('prenomMere', "non renseigné");
        $doc->mergeXmlField('dateNaissanceM', "non renseigné");
        $doc->mergeXmlField('lieuNaissanceM', "non renseigné");
    }

    $madate = $naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 2);


    //--------------------------------------------------------------------------
    // On renseigne la date de l'acte
    $doc->mergeXmlField('dateActe', $dateNorm );

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuée, le nom du document peut etre modifié à guise
    $doc->sendResponse(array ("filename" => "livret_naissance_".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
  }

   /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de reconnaisance Antérieure avec les deux déclarants.
   * Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy - modified: Flament Guillaume
   * @param sfWebRequest $request
   */
public function executeActeReconnaissanceAnterieurePM(sfWebRequest $request){
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieurePM($doc, $naissance);

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reconnaissance_anterieure".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

private function remplirInfosActeRecoAnterieurePM($doc, $naissance){
    $pere = $naissance->getPere();
    $mere = $naissance->getMere();

    $madate = strtotime($naissance->getDateActe());
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 0);
    $dateLettre = $this->getDateEnLettre($madate, 1);

    $heureLettre = $this->getHeureEnLettre($naissance->getHeureActe(), 1);

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());
    $doc->mergeXmlField('dateActe',$dateNorm);
    $doc->mergeXmlField('dateActeLettre', $dateLettre);
    $doc->mergeXmlField('heureActeLettre', $heureLettre);
    $doc->mergeXmlField('anneeActe', $naissance->getAnneeActe($naissance->getId()));
    $doc->mergeXmlField('dateCourante', $this->getCurDate());

    
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
    }

    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
    }

    $doc->mergeXmlField('infosDeclarants', $this->getInfosDeclarants($naissance));

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());
}

   /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de reconnaisance Antérieure avec les deux déclarants.
   * Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy - modified: Flament Guillaume
   * @param sfWebRequest $request
   */
public function executeActeReconnaissanceAnterieureP(sfWebRequest $request){
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieureP($doc, $naissance);
    
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reconnaissance_anterieure".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

  private function remplirInfosActeRecoAnterieureP($doc, $naissance){
    $pere = $naissance->getPere();

    $madate = strtotime($naissance->getDateActe());
    $dateNorm = $this->getDateEnLettre($madate, 0);
    $dateLettre = $this->getDateEnLettre($madate, 1);

    $heureLettre = $this->getHeureEnLettre($naissance->getHeureActe(), 1);

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());
    $doc->mergeXmlField('dateActe', $dateNorm);
    $doc->mergeXmlField('dateActeLettre', $dateLettre);
    $doc->mergeXmlField('heureActeLettre', $heureLettre);
    $doc->mergeXmlField('anneeActe', $naissance->getAnneeActe($naissance->getId()));
    $doc->mergeXmlField('dateCourante', $this->getCurDate());

    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
    }

    $doc->mergeXmlField('infosDeclarants', $this->getInfosDeclarants($naissance));

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());
  }

     /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de reconnaisance Antérieure avec un seul déclarant : la mère.
   * Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
public function executeActeReconnaissanceAnterieureM(sfWebRequest $request)
  {
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieureM($doc, $naissance);
    
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reconnaissance_anterieure".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

private function remplirInfosActeRecoAnterieureM($doc, $naissance){
    $mere = $naissance->getMere();

    $madate = strtotime($naissance->getDateActe());
    $dateNorm = $this->getDateEnLettre($madate, 0);
    $dateLettre = $this->getDateEnLettre($madate, 1);

    $heureLettre = $this->getHeureEnLettre($naissance->getHeureActe(), 1);

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());
    $doc->mergeXmlField('dateActe', $dateNorm);
    $doc->mergeXmlField('dateActeLettre', $dateLettre);
    $doc->mergeXmlField('heureActeLettre', $heureLettre);
    $doc->mergeXmlField('anneeActe', $naissance->getAnneeActe($naissance->getId()));
    $doc->mergeXmlField('dateCourante', $this->getCurDate());

    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
    }

    $doc->mergeXmlField('infosDeclarants', $this->getInfosDeclarants($naissance));

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());
}

  
public function executeActeRecoAnterieureCommunicableM(sfWebRequest $request){
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieureM($doc, $naissance);

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reco_anterieure_communicable".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

public function executeActeRecoAnterieureCommunicableP(sfWebRequest $request){
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieureP($doc, $naissance);

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reco_anterieure_communicable".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

public function executeActeRecoAnterieureCommunicablePM(sfWebRequest $request){
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $naissance = $this->getNaissanceById($request->getParameter("id"));

    $this->remplirInfosActeRecoAnterieurePM($doc, $naissance);

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reco_anterieure_communicable".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();

    throw new sfStopException;
}

   /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de reconnaissance postérieure. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeReconnaissancePosterieure(sfWebRequest $request)
  {
    $naissance = $this->getNaissanceById($request->getParameter("id"));
    
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    $pere = $naissance->getPere();

    $madate = strtotime($naissance->getDateActe());
    $dateNorm = $this->getDateEnLettre($madate, 0);
    $dateLettre = $this->getDateEnLettre($madate, 1);

    $heureLettre = $this->getHeureEnLettre($naissance->getHeureActe(), 1);

    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());

    if($pere != null)
    {
        $doc->mergeXmlField("prenomPere", $pere->getPrenom());
        $doc->mergeXmlField("nomPere", $pere->getNom());
    }

    $doc->mergeXmlField('dateActeLettre', $dateLettre);
    $doc->mergeXmlField('heureActeLettre', $heureLettre);


    $doc->mergeXmlField('infosDeclarants', $this->getInfosDeclarants($naissance));

    //--------------------------------------------------------------------------
    // Pour la bonne conjuguaison, on test le sexe de l'enfant avant 
    // de remplacer dans le document.
    if($naissance->getEnfant()->getSexe() == "masculin") {
        $parente = "son fils ";
        $neA = ", né à "; }
    else {
        $parente = "sa fille ";
        $neA = ", née à"; }

    // Dans le cas ou la mère est renseignée dans l'application
    // on indique ses informations sinon on termine par un " . "
    if ($naissance->MereIsPresent() == 1)
            $infoMere = ", de ".$naissance->getMere()->getPrenom()." ".
                        $naissance->getMere()->getNom().", née le ".
                        $this->getDateEnLettre(strtotime($naissance->getMere()->getDateNaissance()), 0)." à ".
                        Ville_france::getVilleCP(Ville_france::getVilleCP(
                                $naissance->getMere()->getLieuNaissance())).", ".
                        $naissance->getMere()->getProfession().", domiciliée à ".
                        $naissance->getMere()->getDomicile();
    else $infoMere = ".";


    // Enfin, on remplace infoEnfant par les bonnes informations ainsi que les
    $doc->mergeXmlField('infosEnfant',
                $parente.$naissance->getEnfant()->getPrenom()." ".
                                     $naissance->getEnfant()->getNom().$neA.
                                     Ville_france::getVilleCP($naissance->getEnfant()->getLieuNaissance())." le ".
                                     $this->getDateEnLettre((int)$naissance->getEnfant()->getDateNaissance(), 0).
                                     $infoMere
            );
    //--------------------------------------------------------------------------

    // On ajoute les information de l'officier d'Etat civil qui a rédigé le
    // document.
    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    
    $doc->saveXml();
    $doc->close();

    // sauvegarde et supprime le document temporaire !
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_reconnaissance_posterieure".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();
  }

   /**
   * Cette fonction execute la requête permettant la génération
   * de l'acte de changement de nom. Elle est appelée par Symfony, et nécessite de
   * recevoir en parrametre l'Id de l'acte à imprimé
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeChangementDeNom(sfWebRequest $request)
  {
    // On commence par récupéré l'acte par son id
    $naissance = $this->getNaissanceById($request->getParameter("id"));
    // Puis l'enfant et les parents associé
    $enfant = $naissance->getEnfant();
    $pere = $enfant->getPere();
    $mere = $enfant->getMere();

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // Recuperation et formattage de la date de l'acte
    $madate = (int)$naissance->getDateActe();
    $dateNorm = $this->getDateEnLettre(strtotime($madate), 0);
    $dateLettre = $this->getDateEnLettre(strtotime($madate), 1);

    $heureLettre = $this->getHeureEnLettre($naissance->getHeureActe(), 1);

    // On renseigne la date de l'acte
    //--------------------------------------------------------------------------
    $doc->mergeXmlField('numActe', $naissance->getNumeroActe());

    $doc->mergeXmlField('dateActe', $dateLettre);
    $doc->mergeXmlField('heureActe', $heureLettre );

    //--------------------------------------------------------------------------
    // Ssi le Pere est renseigné on complete les informations
    if($pere != null)
    {
        $doc->mergeXmlField('nomPere', $pere->getNom());
        $doc->mergeXmlField('prenomPere', $pere->getPrenom());
        $doc->mergeXmlField('dateNaissancePere', $this->getDateEnLettre(strtotime($pere->getDateNaissance()), 0 ));
        $doc->mergeXmlField('lieuNaissancePere', Ville_france::getVilleDepartement($pere->getLieuNaissance()));
        $doc->mergeXmlField('domicilePere', $pere->getDomicile());
    }

    //--------------------------------------------------------------------------
    // Ssi la Mere est renseignée on complete les informations
    if($mere != null)
    {
        $doc->mergeXmlField('nomMere', $mere->getNom());
        $doc->mergeXmlField('prenomMere', $mere->getPrenom());
        $doc->mergeXmlField('dateNaissanceMere', $this->getDateEnLettre(strtotime($mere->getDateNaissance()), 0));
        $doc->mergeXmlField('lieuNaissanceMere', Ville_france::getVilleDepartement($mere->getLieuNaissance()));
        $doc->mergeXmlField('domicileMere', $mere->getDomicile());
    }

    //--------------------------------------------------------------------------
    // Ssi l'enfant est renseigné on complete les informations
    if($enfant != null)
    {
        $doc->mergeXmlField('nomEnfant', $enfant->getNom());
        $doc->mergeXmlField('prenomEnfant', $enfant->getPrenom());

        $datenaissanceEnfant = $this->getDateEnLettre(strtotime($enfant->getDateNaissance()), 0);
        $doc->mergeXmlField('dateNaissanceEnfant', $datenaissanceEnfant);
        $doc->mergeXmlField('lieuNaissance', Ville_france::getVilleDepartement($enfant->getLieuNaissance()));
        $doc->mergeXmlField('lieuDomicile', $enfant->getDomicile());
        $doc->mergeXmlField('nouveauNom', $enfant->getNouveauNom());
    }

    //--------------------------------------------------------------------------
    // On ajoute les information de l'officier d'Etat civil qui a rédigé le
    // document.
    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    // Enregistrement du Xml et fermeture du flux* en ecriture
    $doc->saveXml();
    $doc->close();

    // sauvegarde et supprime le document temporaire !
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_changement_de_nom".$naissance->getId()."_".$naissance->getDateActe().".odt"));
    $doc->remove();
  }

  /**
   * Cette Fonction a été écrite pour transformaer le jour et le mois d'une date
   * SQL vers une date en lettre.
   *
   * Elle retourne une chaine de charactere sous la forme :
   *        "Lundi 02 Septembre 2011"
   * 
   * @param <int> $date
   * @param <boolean> $toutEnLettre
   * @return <String> 
   *
   */
  public function getDateEnLettre($date, $toutEnLettre)
  {

    $mois = date('F', $date);
    $moisChiffre = date('F', $date);

    switch($mois) {
        case 'January': $mois = 'janvier'; break;
        case 'February': $mois = 'février'; break;
        case 'March': $mois = 'mars'; break;
        case 'April': $mois = 'avril'; break;
        case 'May': $mois = 'mai'; break;
        case 'June': $mois = 'juin'; break;
        case 'July': $mois = 'juillet'; break;
        case 'August': $mois = 'août'; break;
        case 'September': $mois = 'septembre'; break;
        case 'October': $mois = 'octobre'; break;
        case 'November': $mois = 'novembre'; break;
        case 'December': $mois = 'decembre'; break;
        default: $mois =''; break;
    }
    switch($moisChiffre) {
        case 'January': $moisChiffre = '01'; break;
        case 'February': $moisChiffre = '02'; break;
        case 'March': $moisChiffre = '03'; break;
        case 'April': $moisChiffre = '04'; break;
        case 'May': $moisChiffre = '05'; break;
        case 'June': $moisChiffre = '06'; break;
        case 'July': $moisChiffre = '07'; break;
        case 'August': $moisChiffre = '08'; break;
        case 'September': $moisChiffre = '09'; break;
        case 'October': $moisChiffre = '10'; break;
        case 'November': $moisChiffre = '11'; break;
        case 'December': $moisChiffre = '12'; break;
        default: $moisChiffre =''; break;
    }

    $jour_nb = date('d', $date);
    $annee = date('Y', $date);
    
    if ($toutEnLettre == 0)  {  //JJ mois AAAA
        return ($jour_nb." ".$mois." ".$annee);
    }
    if ($toutEnLettre == 1)  {   //jour mois annee
        $jour_nb = $this->int2str($jour_nb);
        $annee = $this->int2str($annee);
        return ($jour_nb." ".$mois." ".$annee);
    }
    if ($toutEnLettre == 2)  {
        return ($jour_nb."  |  ".$moisChiffre."  |  ".$annee);
    }
    
    
  }


  /**
   * Cette fonction transforme une heure de la forme 11:30 vers une heure
   * en lettre.
   *
   * @author Boyer Jimmy
   * @param <int> $heure
   * @return String
   */
  public function getHeureEnLettre($heure, $toutEnLettre)
  {
      if($heure != null)
      {
          $tabHeure = explode(":",$heure);

          $heures = $tabHeure[0];
          $min = $tabHeure[1];

          if ($toutEnLettre == 1)
          {
            $heures = $this->int2str($heures);
            $min = $this->int2str($min);
          }

      //Tests pour savoir si on affiche le "s" à minute(s) et à heure(s)
      (($tabHeure[0]>1) ? $enLettre = $heures." heures " : $enLettre = $heures." heure ");
      (($tabHeure[1]>1) ? $enLettre = $enLettre .$min." minutes" : $enLettre = $enLettre .$min." minute");
      return $enLettre;
      
      } else {
          return "";
      }
  }

  /*
   * Fonction permettant la transformation d'integer en chaine de carractère
   * plus précisement les chiffres en lettres.
   */
  public function int2str($a) {
    $joakim = explode('.',$a);
    if (isset($joakim[1]) && $joakim[1]!=''){
        return $this->int2str($joakim[0]).' virgule '.$this->int2str($joakim[1]) ;
    }
    if ($a<0) return 'moins '.$this->int2str(-$a);
        if ($a<17){
            switch ($a){
                case 0: return 'zéro';
                case 1: return 'premier';            //case 1: return 'un';
                case 2: return 'deux';
                case 3: return 'trois';
                case 4: return 'quatre';
                case 5: return 'cinq';
                case 6: return 'six';
                case 7: return 'sept';
                case 8: return 'huit';
                case 9: return 'neuf';
                case 10: return 'dix';
                case 11: return 'onze';
                case 12: return 'douze';
                case 13: return 'treize';
                case 14: return 'quatorze';
                case 15: return 'quinze';
                case 16: return 'seize';
            }
        } else if ($a<20){
            return 'dix-'.$this->int2str($a-10);
        } else if ($a<100){
            if ($a%10==0){
                switch ($a){
                    case 20: return 'vingt';
                    case 30: return 'trente';
                    case 40: return 'quarante';
                    case 50: return 'cinquante';
                    case 60: return 'soixante';
                    case 70: return 'soixante-dix';
                    case 80: return 'quatre-vingt';
                    case 90: return 'quatre-vingt-dix';
                }
            } elseif (substr($a, -1)==1){
                if( ((int)($a/10)*10)<70 ){
                    return $this->int2str((int)($a/10)*10).'-et-un';
            } elseif ($a==71) {
                    return 'soixante-et-onze';
            } elseif ($a==81) {
                    return 'quatre-vingt-un';
            } elseif ($a==91) {
                    return 'quatre-vingt-onze';
            }
        } elseif ($a<70){
            return $this->int2str($a-$a%10).'-'.$this->int2str($a%10);
        } elseif ($a<80){
            return $this->int2str(60).'-'.$this->int2str($a%20);
        } else{
            return $this->int2str(80).'-'.$this->int2str($a%20);
        }
    } else if ($a==100){
        return 'cent';
    } else if ($a<200){
        return $this->int2str(100).' '.$this->int2str($a%100);
    } else if ($a<1000){
        return $this->int2str((int)($a/100)).' '.$this->int2str(100).' '.$this->int2str($a%100);
    } else if ($a==1000){
        return 'mil';   //return 'mille';
    } else if ($a<2000){
        return $this->int2str(1000).' '.$this->int2str($a%1000).' ';
    } else if ($a<1000000){
        return $this->int2str((int)($a/1000)).' '.$this->int2str(1000).' '.$this->int2str($a%1000);
}
}

  
  /**
   * Cette fonction permet de récupéré l'objet Deces grace à son "id"
   * identifiant unique dans la base de données
   *
   * @param <int> $id
   * @return Naissance
   */
  public function getNaissanceById($id)
  {
      $naissanceC = Doctrine::getTable("Naissance")
        ->createQuery("nai")
            ->where("nai.id = ?", $id)
            ->execute();

      $naissance = $naissanceC->getFirst();

      return $naissance;
  }

  /**
   * Cette fonction permet de récupérer la ville dans la chaine de caractère composée comme suit: ville (codePostal)
   *
   * @author Guillaume FLAMENT
   * @param <string> $lieuNaissance
   * @return string
   */
  public function getVille($lieuNaissance){
      return strstr($lieuNaissance, " (", true);
  }

  /**
   * Cette fonction retourne la date du jour (date courante)
   * @author FLAMENT Guillaume
   * @return string
   */
  public function getCurDate()
  {
      $date=getdate();
      return $this->getDateEnLettre($date[0],0);
  }

  

  /**
   * Cette fonction permet de formatter les informations a remplis sur les actes
   * de naissance concernant les déclarants.
   *
   * @param Naissance $naissance
   * @return string
   */
  public function getInfosDeclarants(Naissance $naissance)
  {
      $ilFautDeuxAdresses = false;

      // On vient d'abord vérifier que les déclarants ( s'ils
      // sont plusieurs) habitent à la même adresse.
      if($naissance->getDeclarants()->count() > 1)
      {
          if ($naissance->getDeclarants()->getFirst()->getDomicile() !=
                  $naissance->getDeclarants()->getLast()->getDomicile())
          {
              // Si oui, on garde en mémoire le fait qu'il va falloir
              // renseigné deux adresses !
              $ilFautDeuxAdresses = true;
          }
      }

      // initialisation de la chaine de charractère qui va être retournée
      $infosDeclarant = "";

      // Pour chacun des déclarants
      foreach ($naissance->getDeclarants() as $declarant){

          // On construit une chaine de carractere comme ci après :
          // Prenom Nom DateNaissance LieuNaissance Proffession
          $infosDeclarant = $infosDeclarant." ".$declarant->getPrenom()
                  ." ".$declarant->getNom();
                  if($declarant->getSexe()=="masculin"){
                      $infosDeclarant = $infosDeclarant.", né le";
                  }else{
                      $infosDeclarant = $infosDeclarant.", née le";
                  }
                  $infosDeclarant = $infosDeclarant." ".$this->getDateEnLettre(strtotime($declarant->getDateNaissance()),0)
                  ." à ".Ville_france::getVilleDepartement(($declarant->getLieuNaissance()))
                  .", ".$declarant->getProfession();
          // On ajoute le domicile par déclarant si et seulement si
          // les deux déclarant n'ont pas la même adresse.
          if ($ilFautDeuxAdresses == true)
          {
              if ($declarant->getSexe() == "masculin")
                $infosDeclarant = $infosDeclarant.", domicilié à ".$declarant->getDomicile();
              else
                $infosDeclarant = $infosDeclarant.", domiciliée à ".$declarant->getDomicile();
          }

          // Si le déclarant est le 1er de la "liste" et qu'il y a plus d'un déclarant,
          // on ajoute "et" pour présenter le suivant.
          if ($declarant == $naissance->getDeclarants()->getFirst() & $naissance->getDeclarants()->count() >1)
          {
              $infosDeclarant = $infosDeclarant." et ";
          }
      }

      // Si les deux déclarant habite à la même adresse
      // ou si le déclarant est seul, alors on ajoute son adresse avec
      // le verbe domicilier correctement accorder.
      if ($ilFautDeuxAdresses == false && $naissance->getDeclarants()->count() != 0)
      {
          // Si il y a plus d'un déclarant
          if($naissance->getDeclarants()->count() > 1)
          {
            // On conjugue "domiciliés"
            $infosDeclarant = $infosDeclarant.", domiciliés à ".$naissance->getDeclarants()->getLast()->getDomicile();
          } else if ($naissance->getDeclarants()->getLast()->getSexe() == "masculin") // sinon si il n'y a que le père
          {
              // domicilié
              $infosDeclarant = $infosDeclarant.", domicilié à ".$naissance->getDeclarants()->getLast()->getDomicile();
          } else if ($naissance->getDeclarants()->getLast()->getSexe() == "feminin") // sinon si il n'y a que la mère
          {
              // domiciliée
              $infosDeclarant = $infosDeclarant." , domiciliée à ".$naissance->getDeclarants()->getLast()->getDomicile();
          }
      }
      // On retourne les informations
      return $infosDeclarant;
  }

  public function executePopUpDocuments(sfWebRequest $request)
  {
    $this->naissance = Doctrine_Core::getTable('Naissance')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->naissance);
  }

}
