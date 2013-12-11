<?php

/**
 * deces actions.
 *
 * @package    etatCivil
 * @subpackage deces
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class decesActions extends sfActions
{

  /**
   * Cette fonction permet d'afficher tous les actes de décès déja
   * enregistrés. Une pagination est effectué et affiche les actes par 20.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()
    ->from('Deces d')
            ->orderBy("d.id DESC");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);

    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);

    $this->pager = new sfDoctrinePager('Deces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();
    
    // On recupere le dernier id du tableau
    $lastId = $q->count();
  }

  /**
   * Cette fonction permet d'afficher le détail d'un acte de deces.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->deces = Doctrine_Core::getTable('Deces')->find(array($request->getParameter('id')));
    
    $this->forward404Unless($this->deces);
  }

  /**
   * Cette fonction permet de créer le formulaire d'un nouvel acte de deces.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DecesForm();
  }

  /**
   * Cette fonction permet d'afficher le formulaire de création d'un acte
   * de deces.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DecesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

    /**
   * Cette fonction permet d'entré en édition sur l'acte de deces selectionné.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($deces = Doctrine_Core::getTable('Deces')
            ->find(array($request->getParameter('id'))),
                    sprintf('Object deces does not exist (%s).',
                    $request->getParameter('id')));
    
    $this->form = new DecesForm($deces);
  }

  /**
   * Cette fonction permet d'insérrer dans la BDD les informations de l'acte
   * de deces modifié.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) 
            || $request->isMethod(sfRequest::PUT));
    
    $this->forward404Unless($deces = Doctrine_Core::getTable('Deces')
            ->find(array($request->getParameter('id'))),
                        sprintf('Object deces does not exist (%s).',
                        $request->getParameter('id')));

    $this->form = new DecesForm($deces);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  /**
   * Cette fonction permet de supprimer l'acte de deces selectionné.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($deces = Doctrine_Core::getTable('Deces')
            ->find(array($request->getParameter('id'))),
                    sprintf('Object deces does not exist (%s).',
                    $request->getParameter('id')));
    
    $deces->delete();

    $this->redirect('deces/index');
  }

  /**
   * @version 1.0
   *
   *  fonction permet de rechercher l'acte de déces depuis les formulaires
   * 
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeSearch(sfWebRequest $request)
  {
      // Création et affichage de notre formulaire de recherche
      $this->form = new SearchDecesForm();
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
      * formulaire de recherche ( SearchDecesForm ) Puis d'ajouter une ligne
      * "andWhere" similaire a celles ci dessous
      */
      $q = Doctrine_Query::create()
        ->select("*")
        ->from("Deces d")
        ->where("d.nomDefunt LIKE ?"            ,"%".$recherche["Nom Defunt"]."%")
        ->andWhere("d.prenomDefunt LIKE ?"      ,"%".$recherche["Prenom Defunt"]."%")
        ->andWhere("YEAR(d.dateActe) LIKE ?"    ,"%".$recherche["Date Acte"]["year"]."%")
        ->andWhere("MONTH(d.dateActe) LIKE ?"   ,"%".$recherche["Date Acte"]["month"]."%")
        ->andWhere("DAY(d.dateActe) LIKE ?"     ,"%".$recherche["Date Acte"]["day"]."%")
        ->andWhere("d.id LIKE ?"                ,"%".$recherche["Id Acte"]."%")
        ->andWhere("d.typeActe LIKE ?"          ,"%".$recherche["TypeActe"]."%" )
        ->andWhere("YEAR(d.dateTranscription) LIKE ?"   ,"%".$recherche["DateTranscription"]["year"]."%")
        ->andWhere("MONTH(d.dateTranscription) LIKE ?"  ,"%".$recherche["DateTranscription"]["month"]."%")
        ->andWhere("DAY(d.dateTranscription) LIKE ?"    ,"%".$recherche["DateTranscription"]["day"]."%");

    // Le nombre de résultats par page a afficher :
    $nbResults = sfConfig::get('app_posts_number_per_page', 10);
    // on conserve la recherche
    $this->RechercheC = $recherche;
    // Le numéro de la page a afficher :
    $numPage = $request->getParameter('page', 1);
    // On demande a notre plugin d'afficher nbResult résultats par page
    $this->pager = new sfDoctrinePager('Deces', $nbResults);

    // /!\ Le pager prends en paramètre une requête doctrine.
    $this->pager->setQuery($q);
    $this->pager->setPage($numPage);
    $this->pager->init();

    // On stock dans une variable ( ci besoin ) le nombre de de résultats total
    $this->lastId = $q->count();
  }

  /**
   * Cette fonction permet d'enregisrter les données d'un formulaire dans la BDD.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $deces = $form->save();

      $this->redirect('deces/show?id='.$deces->getId());
    }
  }

  /**
   * Fonction permettant la génération de l'acte de Deces, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeDeces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());
    //--------------------------------------------------------------------------
    // Si le Defunt est un homme on accorde ce qu'il faut dans l'acte
    if($deces->getSexeDefunt() == "masculin") {
        $doc->mergeXmlField('deceder', "décedé");
        $doc->mergeXmlField('naitre', "né");
        $doc->mergeXmlField('filsFille', "fils");
    } else {
        $doc->mergeXmlField('deceder', "décedée");
        $doc->mergeXmlField('naitre', "née");
        $doc->mergeXmlField('filsFille', "fille");
    }
    // On fait la même chose pour le declarant
    if ($deces->getSexeDeclarant()) {
            $doc->mergeXmlField('domicileD', "domicilié ");
            $doc->mergeXmlField('inviter', "invité");
    } else {
            $doc->mergeXmlField('domicileD', "domicilié ");
            $doc->mergeXmlField('inviter', "invitée");
    }
    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateLettre = $this->getDateEnLettre((int)$madate, 0);
    $doc->mergeXmlField('jour', $this->getDateEnLettre(strtotime($madate), 1));
    
    $doc->mergeXmlField('dateD', $dateLettre);
    $doc->mergeXmlField('heureD', $this->getHeureEnLettre($deces->getHeureDeces(),0));
    // On récupere la ville par le biais de son Id -- la ville sera forcément Voreppe puisqu'il s'agit d'un acte!
    //$doc->mergeXmlField('lieuDeces', strstr(Ville_france::getVilleDepartement($deces->getLieuDeces()),") ",true));
    
    // Si une rue est rensigné on l'ajoute
    if($deces->getRueDeces())
        if($deces->getensondomicile()==0){  //si la personne n'est pas morte chez elle, on renseigne son domicile
            $doc->mergeXmlField('rueDeces', $deces->getRueDeces());
            $doc->mergeXmlField('domicileDefunt', " " .$deces->getDomicileDefunt(). ", ");
            if($deces->getSexeDefunt() == "masculin"){
                $doc->mergeXmlField('domicile', " domicilié à ");
            }else{
                $doc->mergeXmlField('domicile', " domiciliée à ");
            }
        }else{  //si la personne est morte en son domcile, on affiche en son domicile suivi de son adresse
            $doc->mergeXmlField('rueDeces', "en son domicile, ".$deces->getRueDeces());
            $doc->mergeXmlField('domicileDefunt', "");  //champ remplacé par une chaine vide car non nécessaire
            $doc->mergeXmlField('domicile', "");    //champ remplacé par une chaine vide car non nécessaire
        }
    else
        $doc->mergeXmlField('rueDeces', "");

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));
    $doc->mergeXmlField('professionDefunt', $deces->getProfessionDefunt());
    $doc->mergeXmlField('nomPrenomMereDefunt', $deces->getPrenomMereDefunt()." ".$deces->getNomMereDefunt());
    $doc->mergeXmlField('nomPrenomPereDefunt', $deces->getPrenomPereDefunt()." ".$deces->getNomPereDefunt());

    if($deces->getStatutMatrimoniale() == "marié(e)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epoux de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epouse de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } else if($deces->getStatutMatrimoniale() == "veuf(ve)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuf de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuve de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } else if($deces->getStatutMatrimoniale() == "célibataire" || $deces->getStatutMatrimoniale() == "divorcé(e)") {
            $doc->mergeXmlField('nomPrenomEpoux(se)2', "Célibataire");
    } elseif ($deces->getStatutMatrimoniale() == "pacsé(e)"){
        ($deces->getSexeDefunt() == "masculin")? $lier="Lié" : $lier="Liée";
        $doc->mergeXmlField('nomPrenomEpoux(se)2', $lier." par un pacte civil de solidarité avec ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
    }

    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));
    $doc->mergeXmlField('heureActe', $this->getHeureEnLettre($deces->getHeureActe(), 1));
    $doc->mergeXmlField('nomDeclarant', $deces->getNomDeclarant());
    $doc->mergeXmlField('prenomDeclarant', $deces->getPrenomDeclarant());
    $doc->mergeXmlField('ageDeclarant', $deces->getAgeDeclarant());
    $doc->mergeXmlField('professionDeclarant', $deces->getProfessionDeclarant());
    $doc->mergeXmlField('adresseDeclarant', $deces->getAdresseDeclarant());

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_deces_".$deces->getId()."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

   /**
   * Fonction permettant la génération de l'acte Deces communicable, elle
   * est appelée par Symfony, et nécessite de recevoir en parrametre l'Id du
   * deces à imprimer.
   *
   * @author FLZMENT Guillaume
   * @param sfWebRequest $request
   */
  public function executeActeDecesCommunicable(sfWebRequest $request)
  {
    $deces = $this->getDecesById($request->getParameter("id"));
    
    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());
    $doc->mergeXmlField('anneeActe', $deces->getAnneeActe($deces->getId()));
    $doc->mergeXmlField('dateCourante', $this->getCurDate());

    //--------------------------------------------------------------------------
    // Si le Defunt est un homme on accorde ce qu'il faut dans l'acte
    if($deces->getSexeDefunt() == "masculin") {
        $doc->mergeXmlField('deceder', "décedé");
        $doc->mergeXmlField('naitre', "né");
        $doc->mergeXmlField('filsFille', "fils");
    } else {
        $doc->mergeXmlField('deceder', "décedée");
        $doc->mergeXmlField('naitre', "née");
        $doc->mergeXmlField('filsFille', "fille");
    }
    // On fait la même chose pour le declarant
    if ($deces->getSexeDeclarant()) {
            $doc->mergeXmlField('domicileD', "domicilié ");
            $doc->mergeXmlField('inviter', "invité");
    } else {
            $doc->mergeXmlField('domicileD', "domicilié ");
            $doc->mergeXmlField('inviter', "invitée");
    }
    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateLettre = $this->getDateEnLettre((int)$madate, 0);
    $doc->mergeXmlField('jour', $this->getDateEnLettre(strtotime($madate), 1));

    $doc->mergeXmlField('dateD', $dateLettre);
    $doc->mergeXmlField('heureD', $this->getHeureEnLettre($deces->getHeureDeces(),0));
    // On récupere la ville par le biais de son Id -- la ville sera forcément Voreppe puisqu'il s'agit d'un acte!
    //$doc->mergeXmlField('lieuDeces', strstr(Ville_france::getVilleDepartement($deces->getLieuDeces()),") ",true));

    // Si une rue est rensigné on l'ajoute
    if($deces->getRueDeces())
        if($deces->getensondomicile()==0){  //si la personne n'est pas morte chez elle, on renseigne son domicile
            $doc->mergeXmlField('rueDeces', $deces->getRueDeces());
            $doc->mergeXmlField('domicileDefunt', " " .$deces->getDomicileDefunt(). ", ");
            if($deces->getSexeDefunt() == "masculin"){
                $doc->mergeXmlField('domicile', " domicilié à ");
            }else{
                $doc->mergeXmlField('domicile', " domiciliée à ");
            }
        }else{  //si la personne est morte en son domcile, on affiche en son domicile suivi de son adresse
            $doc->mergeXmlField('rueDeces', "en son domicile, ".$deces->getRueDeces());
            $doc->mergeXmlField('domicileDefunt', "");  //champ remplacé par une chaine vide car non nécessaire
            $doc->mergeXmlField('domicile', "");    //champ remplacé par une chaine vide car non nécessaire
        }
    else
        $doc->mergeXmlField('rueDeces', "");

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));
    $doc->mergeXmlField('professionDefunt', $deces->getProfessionDefunt());
    $doc->mergeXmlField('nomPrenomMereDefunt', $deces->getPrenomMereDefunt()." ".$deces->getNomMereDefunt());
    $doc->mergeXmlField('nomPrenomPereDefunt', $deces->getPrenomPereDefunt()." ".$deces->getNomPereDefunt());

    if($deces->getStatutMatrimoniale() == "marié(e)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epoux de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epouse de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } else if($deces->getStatutMatrimoniale() == "veuf(ve)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuf de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuve de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } else if($deces->getStatutMatrimoniale() == "célibataire" || $deces->getStatutMatrimoniale() == "divorcé(e)") {
            $doc->mergeXmlField('nomPrenomEpoux(se)2', "Célibataire");
    } else if ($deces->getStatutMatrimoniale() == "pacsé(e)"){
            $deces->getSexeDefunt() == "masculin"? $lier="Lié" : $lier="Liée";
            $doc->mergeXmlField('nomPrenomEpoux(se)2', $lier." par un pacte civil de solidarité avec ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
    }

    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));
    $doc->mergeXmlField('heureActe', $this->getHeureEnLettre($deces->getHeureActe(), 1));
    $doc->mergeXmlField('nomDeclarant', $deces->getNomDeclarant());
    $doc->mergeXmlField('prenomDeclarant', $deces->getPrenomDeclarant());
    $doc->mergeXmlField('ageDeclarant', $deces->getAgeDeclarant());
    $doc->mergeXmlField('professionDeclarant', $deces->getProfessionDeclarant());
    $doc->mergeXmlField('adresseDeclarant', $deces->getAdresseDeclarant());

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_deces_com_".$deces->getId()."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();
    //throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'acte de Transcription de Deces, elle
   * est appelée par Symfony, et nécessite de recevoir en parrametre l'Id du
   * deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeActeTranscriptionDeces(sfWebRequest $request)
  {

    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());
    //--------------------------------------------------------------------------
    // Si le Defunt est un homme on accorde ce qu'il faut dans l'acte
    if($deces->getSexeDefunt() == "masculin") {
        $doc->mergeXmlField('deceder', "décedé");
        $doc->mergeXmlField('naitre', "né");
        $doc->mergeXmlField('domicile', "domicilié");
        $doc->mergeXmlField('filsFille', "fils");
    } else {
        $doc->mergeXmlField('deceder', "décedée");
        $doc->mergeXmlField('naitre', "née");
        $doc->mergeXmlField('domicile', "domiciliée");
        $doc->mergeXmlField('filsFille', "fille");
    }
    // On fait la même chose pour le declarant
    if ($deces->getSexeDeclarant() == "masculin" ) {
            $doc->mergeXmlField('domicileD', "domicilié");
            $doc->mergeXmlField('inviter', "invité");
    } else {
            $doc->mergeXmlField('domicileD', "domicilié");
            $doc->mergeXmlField('inviter', "invitée");
    }
    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateLettre = $this->getDateEnLettre($madate, 0);
    $doc->mergeXmlField('jour', $this->getDateEnLettre(strtotime($madate), 1));

    $doc->mergeXmlField('dateD', $dateLettre);
    $doc->mergeXmlField('heureD', $this->getHeureEnLettre($deces->getHeureDeces(), 0));
    // On récupere la ville par le biais de son Id
    //$doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));
    // Si une rue est rensigné on l'ajoute
    if($deces->getRueDeces()){
        $doc->mergeXmlField('rueDeces', $deces->getRueDeces());
    }else{
        $doc->mergeXmlField('rueDeces', "");
    }
    if($deces->getLieuDeces()){
        $doc->mergeXmlField('villeDeces', " à " .Ville_france::getVilleDepartement($deces->getLieuDeces()));
    }else{
        $doc->mergeXmlField('villeDeces', "");
    }
    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));
    $doc->mergeXmlField('professionDefunt', $deces->getProfessionDefunt());
    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    $doc->mergeXmlField('nomPrenomMereDefunt', $deces->getPrenomMereDefunt()." ".$deces->getNomMereDefunt());
    $doc->mergeXmlField('nomPrenomPereDefunt', $deces->getPrenomPereDefunt()." ".$deces->getNomPereDefunt());

    if($deces->getStatutMatrimoniale() == "marié(e)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epoux de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {;
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Epouse de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } elseif ($deces->getStatutMatrimoniale() == "veuf(ve)") {
            if($deces->getSexeDefunt() == "masculin") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuf de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            } else {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Veuve de ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
            }
    } elseif ($deces->getStatutMatrimoniale() == "célibataire" || $deces->getStatutMatrimoniale() == "divorcé(e)") {
                $doc->mergeXmlField('nomPrenomEpoux(se)2', "Célibataire");
    } elseif ($deces->getStatutMatrimoniale() == "pacsé(e)") {
        ($deces->getSexeDefunt() == "masculin")? $lier="Lié" : $lier="Liée";
        $doc->mergeXmlField('nomPrenomEpoux(se)2', $lier." par un pacte civil de solidarité avec ".$deces->getPrenomConjoint()." ".$deces->getNomConjoint());
    }
       

    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));
    $doc->mergeXmlField('heureActe', $this->getHeureEnLettre($deces->getHeureActe(), 1));
    $doc->mergeXmlField('nomDeclarant', $deces->getNomDeclarant());
    $doc->mergeXmlField('prenomDeclarant', $deces->getPrenomDeclarant());
    $doc->mergeXmlField('ageDeclarant', $deces->getAgeDeclarant());
    $doc->mergeXmlField('professionDeclarant', $deces->getProfessionDeclarant());
    $doc->mergeXmlField('adresseDeclarant', $deces->getAdresseDeclarant());

    $doc->mergeXmlField('prenomU', $this->getUser()->getAttribute("MyClient")->getPrenom());
    $doc->mergeXmlField('nomU', $this->getUser()->getAttribute("MyClient")->getNom());
    $doc->mergeXmlField('infoU', $this->getUser()->getAttribute("MyClient")->getFonction());

    if ($deces->getOfficierEtatCivil() != null) {
        $doc->mergeXmlField('infoOfficierEtatCivil', Officiers::getPrenomOfficier($deces->getOfficierEtatCivil())
                .' '. Officiers::getNomOfficier($deces->getOfficierEtatCivil())
                .", "
                .Officiers::getFonctionOfficier($deces->getOfficierEtatCivil()));
    } else {
        $doc->mergeXmlField('infoOfficierEtatCivil', $this->getUser()->getAttribute("MyClient")->getPrenom()
                ." ".$this->getUser()->getAttribute("MyClient")->getNom()
                ." ".$this->getUser()->getAttribute("MyClient")->getFonction() );
    }

    $doc->mergeXmlField('communeT', $deces->getCommuneTranscription() );
    $doc->mergeXmlField('dateTranscription', $this->getDateEnLettre(strtotime($deces->getDateTranscription()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_transcription_deces_"
            .$deces->getId()
            ."_"
            .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
            .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'acte plurilingue de Deces, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executePlurilinguesDeces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('etat', "France");
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    $doc->mergeXmlField('sexeDefunt', $deces->getSexeDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 2);
    $doc->mergeXmlField('dateDecesF', $dateDecesF);
    
    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNDefuntF', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 2));


    $doc->mergeXmlField('nomMereD', $deces->getNomMereDefunt());
    $doc->mergeXmlField('nomPereD', $deces->getNomPereDefunt());
    $doc->mergeXmlField('prenomMereD', $deces->getPrenomMereDefunt());
    $doc->mergeXmlField('prenomPereD', $deces->getPrenomPereDefunt());


    if ($deces->getStatutMatrimoniale() == "célibataire" ) {
        $doc->mergeXmlField('prenomPrecConjoint', "");
        $doc->mergeXmlField('nomPrecConjoint', "");

    } else
    {
        $doc->mergeXmlField('prenomPrecConjoint', $deces->getPrenomConjoint());
        $doc->mergeXmlField('nomPrecConjoint', $deces->getNomConjoint());
    }
    
    
    $doc->mergeXmlField('dateActeF', $this->getDateEnLettre(strtotime($deces->getDateActe()), 2));

    

    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "acte_plurilingue_deces_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'acte plurilingue de Deces, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeDocImpotsDeces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    $doc->mergeXmlField('professionDefunt', $deces->getProfessionDefunt());
    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    $doc->mergeXmlField('statutMatrimoniale', $deces->getStatutMatrimoniale());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 3);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 2));


    $doc->mergeXmlField('nomMereD', $deces->getNomMereDefunt());
    $doc->mergeXmlField('nomPereD', $deces->getNomPereDefunt());
    $doc->mergeXmlField('prenomMereD', $deces->getPrenomMereDefunt());
    $doc->mergeXmlField('prenomPereD', $deces->getPrenomPereDefunt());


    if ($deces->getStatutMatrimoniale() == "célibataire" ) {
        $doc->mergeXmlField('prenomPrecConjoint', "");
        $doc->mergeXmlField('nomPrecConjoint', "");

    } else
    {
        $doc->mergeXmlField('prenomPrecConjoint', $deces->getPrenomConjoint());
        $doc->mergeXmlField('nomPrecConjoint', $deces->getNomConjoint());
    }


    $doc->mergeXmlField('dateActeF', $this->getDateEnLettre(strtotime($deces->getDateActe()), 2));



    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "doc_impots_deces_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de mention de Deces, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionDeces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('ville', "Voreppe (Isère)");
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);
  
    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));
    $doc->mergeXmlField('villeNaissance', $this->getVille(Ville_france::getVilleCP($deces->getLieuNaissanceDefunt())));
    $doc->mergeXmlField('CP', $this->getCP(Ville_france::getVilleCP($deces->getLieuNaissanceDefunt())));
    //Accords en fonction du sexe du défunt
    if($deces->getSexeDefunt()=="masculin"){
        $doc->mergeXmlField('naitre', "Né");
        $doc->mergeXmlField('deceder', "Décédé");
    }else{
        $doc->mergeXmlField('naitre', "Née");
        $doc->mergeXmlField('deceder', "Décédée");
    }

    ($deces->getSexeDefunt()=="masculin")? $interesser="L'intéressé" : $interesser="L'intéressée";
    $doc->mergeXmlField('interesser', $interesser);

    if ($deces->getNomConjoint()!="" && $deces->getStatutMatrimoniale()=='pacsé(e)'){
        $doc->mergeXmlField('prenomConjoint', $deces->getPrenomConjoint());
        $doc->mergeXmlField('nomConjoint', $deces->getNomConjoint());
    }else{
        $doc->mergeXmlField('prenomConjoint', "");
        $doc->mergeXmlField('nomConjoint', "");
    }

    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de mention pour le procureur, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionDecesProc(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));

    if ($deces->getNomConjoint()!="" && $deces->getStatutMatrimoniale()=='pacsé(e)'){
        $doc->mergeXmlField('prenomConjoint', $deces->getPrenomConjoint());
        $doc->mergeXmlField('nomConjoint', $deces->getNomConjoint());
    }else{
        $doc->mergeXmlField('prenomConjoint', "");
        $doc->mergeXmlField('nomConjoint', "");
    }

    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_procureur_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));
    
    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de mention pour varces, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionDecesVarces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());

    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));


    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_varces_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de transcription, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisTranscriptionDeces(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());

    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));


    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_transcription_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de notoriete, elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionNotoriete(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());

    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));


    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_notoriete_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }

  /**
   * Fonction permettant la génération de l'avis de notoriete pour le procureur,
   * elle est appelée par
   * Symfony, et nécessite de recevoir en parrametre l'Id du deces à imprimé.
   *
   * @author Boyer Jimmy
   * @param sfWebRequest $request
   */
  public function executeAvisMentionNotorieteProc(sfWebRequest $request)
  {
    // On récupere le Deces avec l'Id recu en parametre
    $deces = $this->getDecesById($request->getParameter("id"));

    // On crée le document
    $doc = new sfTinyDoc();
    $doc->createFrom();
    $doc->loadXml('content.xml');

    //--------------------------------------------------------------------------
    // On commence a remplacer les balises
    $doc->mergeXmlField('numActe', $deces->getNumeroActe());

    //--------------------------------------------------------------------------
    // On remplace les information du defunt
    $doc->mergeXmlField('nomDefunt', $deces->getNomDefunt());
    $doc->mergeXmlField('prenomDefunt', $deces->getPrenomDefunt());

    $doc->mergeXmlField('domicileDefunt', $deces->getDomicileDefunt());
    //--------------------------------------------------------------------------
    // Information concernant le décés
    $madate = strtotime($deces->getDateDeces());
    $dateDecesF = $this->getDateEnLettre($madate, 1);
    $doc->mergeXmlField('dateDeces', $dateDecesF);

    // On récupere la ville par le biais de son Id
    $doc->mergeXmlField('lieuDeces', Ville_france::getVilleDepartement($deces->getLieuDeces()));

    //--------------------------------------------------------------------------
    // Informations concernant le Defunt.
    $doc->mergeXmlField('lieuNaissanceDefunt', Ville_france::getVilleDepartement($deces->getLieuNaissanceDefunt()));
    $doc->mergeXmlField('dateNaissanceDefunt', $this->getDateEnLettre(strtotime($deces->getDateNaissanceDefunt()), 1));


    $doc->mergeXmlField('dateActe', $this->getDateEnLettre(strtotime($deces->getDateActe()), 1));


    $doc->saveXml();
    $doc->close();

    // send and remove the document
    // surcharge effectuer, le nom du document peut etre modifier a guise
    $doc->sendResponse(array ("filename" => "avis_mention_notoriete_procureur_"
        .$deces->getId()
        ."_"
        .$this->getDateEnLettre(strtotime($deces->getDateActe()),3)
        .".odt"));

    $doc->remove();

    throw new sfStopException;
  }




  /**
   * Cette Fonction a été écrite pour écrire le jour et le mois de la date
   * en lettre
   *
   * Elle retourne une chaine de charactere sous la forme :
   *        "Lundi 02 Septembre 2011"
   * @author Boyer Jimmy
   * @param int $date
   * @return String
   */
  public function getDateEnLettre($date, $format)
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
    
    if($format == 0) {         // dix septembre deux mil onze

        $jour_nb = $this->int2str($jour_nb);
        $annee = $this->int2str($annee);

        return ($jour_nb." ".$mois." ".$annee);
     
    } else if ($format == 1) { // 10 Septembre 2011
        return ($jour_nb." ".$mois." ".$annee);
        
    } else if ($format == 2) { // 10 | 09 | 2011
        return ($jour_nb."|".$moisChiffre."|".$annee);

    } else if ($format == 3) {// 10 / Septembre / 2011
        return ($jour_nb."/".$mois."/".$annee);
    }
    
    
  }

  /**
   * Cette fonction assure la transformation de nos heures en Lettre
   *
   * @author Boyer Jimmy
   * @param <int> $heure
   * @return string
   */
  public function getHeureEnLettre($heure, $format)
  {
      $tabHeure = explode(":",$heure);

      $heures = $tabHeure[0];
      $min = $tabHeure[1];

      if ($format == 0)
      {
        $heures = $this->int2str($heures);
        $min = $this->int2str($min);
      }

      //Tests pour savoir si on affiche le "s" à minute(s) et à heure(s)
      (($tabHeure[0]>1) ? $enLettre = $heures." heures " : $enLettre = $heures." heure ");
      (($tabHeure[1]>1) ? $enLettre = $enLettre .$min." minutes" : $enLettre = $enLettre .$min." minute");
      return $enLettre;
  }

  /**
   * Fonction récupéré sur le site Developpez.net, autheur inconnu
   * qui permet de transformer les chiffre en lettre.
   * @param <int> $a
   * @return String
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
                case 1: return 'premier';
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
   * @param int $id
   * @return Deces
   */
  public function getDecesById($id)
  {
      $decesC = Doctrine::getTable("Deces")
        ->createQuery("dec")
            ->where("dec.id = ?", $id)
            ->execute();

      $deces = $decesC->getFirst();

      return $deces;
  }


  /**
   * Cette fonction retourne la date du jour (date courante)
   * @author FLAMENT Guillaume
   */
  public function getCurDate()
  {
      $date=getdate();
      return $this->getDateEnLettre($date[0],1);
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

  public function getCP($lieuNaissance){
      return substr($lieuNaissance,-6,5);
  }
  

  /* Ajax call
   * @param sfWebRequest $request
   * @return Json return Json array of matching City objects converted to string
   */
  public function executeGetVilles(sfWebRequest $request)       //Se trouve dans décès mais est appellée dans les autres modules
  {
    $q = $request->getParameter('q');
    
    $limit = $request->getParameter('limit');

    $citys = Doctrine::getTable('Ville_france')->createQuery("c")
            ->where('c.ville = ?', $q)
            ->orwhere('c.ville LIKE ?', '%'.$q.'%')  //Avant il y avait: ".$q.'%'" ce qui ne récupérait pas certaines ville comme Avignon
            //->orWhere('c.CP LIKE ?', '%'.$q.'%')    //Permet aussi de récupérer les villes grace à leur code postal
            //->limit($limit)
            ->limit(30)
            ->execute();

    $list = array();
    foreach($citys as $city)
    {
       $list[$city->getId()] = sprintf('%s (%s)', $city->getVille(), $city->getDepartement());
    }

    return $this->renderText(json_encode($list));
  }

  public function executePopUpDocuments(sfWebRequest $request)
  {
    $this->deces = Doctrine_Core::getTable('Deces')->find(array($request->getParameter('id')));

    $this->forward404Unless($this->deces);
  }

}
