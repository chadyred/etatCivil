<?php

/**
 * utilisateur actions.
 *
 * @package    etatCivil
 * @subpackage utilisateur
 * @author     Boyer Jimmy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class utilisateurActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        // initialisation d'un nouveau formulaire de type LOGIN
        // loginform a été crée au préalable
        $this->form = new LoginForm();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('login'));
            if ($this->form->isValid()) {
                // authenticate user and redirect them
                $this->verifLogin();
            }
        }
        sfView::SUCCESS;
    }

    public function executeShow(sfWebRequest $request) {
        $this->utilisateur = Doctrine_Core::getTable('Utilisateur')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->utilisateur);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new UtilisateurForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UtilisateurForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($utilisateur = Doctrine_Core::getTable('Utilisateur')->find(array($request->getParameter('id'))), sprintf('Object utilisateur does not exist (%s).', $request->getParameter('id')));
        $this->form = new UtilisateurForm($utilisateur);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($utilisateur = Doctrine_Core::getTable('Utilisateur')->find(array($request->getParameter('id'))), sprintf('Object utilisateur does not exist (%s).', $request->getParameter('id')));
        $this->form = new UtilisateurForm($utilisateur);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($utilisateur = Doctrine_Core::getTable('Utilisateur')->find(array($request->getParameter('id'))), sprintf('Object utilisateur does not exist (%s).', $request->getParameter('id')));
        $utilisateur->delete();

        $this->redirect('utilisateur/index');
    }

    public function executeSelection(sfWebRequest $request) {

        $this->form = new DateForm();

        sfView::SUCCESS;
    }

    public function executeEnConstruction(sfWebRequest $request) {
        sfView::SUCCESS;
    }

    /**
     * Cette méthode procède à la vérification de l'existance de
     * l'utilisateur dans la base de donnée. En cas d'erreur, redirection
     * vers cette même page avec le forulaire vide.
     * Si le Login+Mdp est correct, redirection vers la page index des naissance ( temporaire )
     *
     * @author Boyer Jimmy
     * @return sfView::none
     */
    private function verifLogin() {
        $login = $this->getRequestParameter('login');


        $results =
                Doctrine::getTable('Utilisateur')
                ->createQuery('user')
                ->where('user.login=?', $login['Identifiant'])
                ->andWhere('user.password=?', $login['Mot de passe'])
                ->execute();

        if ($results->count() != 0) {
            foreach ($results as $user) {
                $this->getUser()->setFlash('notice', 'Succès de l\'Identification.');
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->setAttribute("logged", true);
                $this->getUser()->setAttribute("MyClient", $user);
                $this->getUser()->setAttribute("droits", $user->getDroits());

                $this->getUser()->addCredential($user->getDroits());

                // Forward
                $this->redirect('utilisateur/selection'); // module + '/' + action (listSuccess.php)
            }
        } else {
            $this->getUser()->setFlash('error', 'Echec de l\'Identification.');
        }

        // on indique ici que cette méthode n'appelle aucune vue !
        return sfView::NONE;
    }

    /**
     * Cette fonction execute la requête permettant la génération
     * des tables annuelles.
     * Elle est appelée par Symfony, et nécessite de
     * recevoir en parrametre un array d'acte.
     *
     * @author Boyer Jimmy
     * @author Flament Guillaume
     * @param sfWebRequest $request
     */
    public function executeTablesAnnuelle(sfWebRequest $request) {
        $recherche = $request->getParameter("Recherche");
        $date = $recherche["Date"]["year"];
        /* Acte de naissance */
        $naissances = Doctrine_Query::create()
                ->select("*")
                ->from("naissance n")
                ->where("YEAR(n.dateActe) =?", $date)
                ->execute();

        $array = $naissances->toArray();
        // Cette boucle va nous permettre de retrouver les enfant de nos actes de
        // Naissance
        $i = 0;

        foreach ($naissances as $naissance) {
            if ($naissance->getEnfant() != null) {
                //$array[$i]["id"] = $naissance->getId();
                $array[$i]["nom"] = $naissance->getEnfant()->getNom();
                $array[$i]["prenom"] = $naissance->getEnfant()->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieuNaissance"] = Ville_france::getVilleDepartement($naissance->getEnfant()->getLieuNaissance());
                // Si il s'ajout d'une reconnaissance, on affiche le nom + prénom du père car l'enfant n'est pas encore né,
                // donc pas enregistré. Sinon, on affiche le nom et prénom de la mère.
                // Parfois aucun déclarant n'est enregistré, il faut aussi gérer ce cas sinon des erreurs sont engendrées lors
                // de la génération des tables annuelles ou décénales
            } elseif ($naissance->PereIsPresent()) {
                $pere = $naissance->getPere();
                $array[$i]["nom"] = $pere->getNom();
                $array[$i]["prenom"] = $pere->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieuNaissance"] = Ville_france::getVilleDepartement($pere->getLieuNaissance());
            } elseif ($naissance->MereIsPresent()) {
                $mere = $naissance->getMere();
                $array[$i]["nom"] = $mere->getNom();
                $array[$i]["prenom"] = $mere->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieuNaissance"] = Ville_france::getVilleDepartement($mere->getLieuNaissance());
            } else {
                die($naissance->getId());
            }
            $i++;
        }

        /* ---------------------- */

        /* Acte de Mariage */
        /* Attention ! La generation doit normalement s'effectuer sur les date des Actes
         * Cependant, lors de l'importation des données, la date de l'acte n'était pas présente
         * c'est pour cela que l'on effectue cette génération sur la date de Mariage
         *
         */
        $mariages = Doctrine_Query::create()
                ->select("*")
                ->from("mariage m")
                ->where("YEAR(m.dateMariage) =?", $date)
                ->execute();

        $arrayM = $mariages->toArray();

        $i = 0;

        foreach ($mariages as $mariage) {
            $arrayM[$i]["nomConjoint1"] = $mariage->getConjoint1()->getNom();
            $arrayM[$i]["prenomConjoint1"] = $mariage->getConjoint1()->getPrenom();
            $arrayM[$i]["nomConjoint2"] = $mariage->getConjoint2()->getNom();
            $arrayM[$i]["prenomConjoint2"] = $mariage->getConjoint2()->getPrenom();
            $arrayM[$i]["numeroacte"] = $mariage->getNumeroActe();
            $arrayM[$i]["datemariage"] = date("d/m/Y", strtotime($mariage->getDateMariage()));
            $i++;
        }

        /* ---------------------- */

        /* Acte de Déces */
        $decess = Doctrine_Query::create()
                ->select("*")
                ->from("deces d")
                ->where("YEAR(d.dateActe) =?", $date)
                ->execute();

        $arrayD = $decess->toArray();

        $i = 0;
        foreach ($decess as $deces) {
            $arrayD[$i]["nomDefunt"] = $deces->getNomDefunt();
            $arrayD[$i]["prenomDefunt"] = $deces->getPrenomDefunt();
            $arrayD[$i]["statutMatrimoniale"] = $deces->getStatutMatrimoniale();
            $arrayD[$i]["nomConjoint"] = $deces->getNomConjoint();
            $arrayD[$i]["numeroActe"] = $deces->getNumeroActe();
            $arrayD[$i]["dateActe"] = date("d/m/Y", strtotime($deces->getDateActe()));
            $arrayD[$i]["lieuDeces"] = Ville_france::getVilleDepartement($deces->getLieuDeces());
            $i++;
        }

        /* ---------------------- */
        // On crée le document
        $doc = new sfTinyDoc();

        //Si le document est un ods
        $doc->createFrom(array('extension' => 'ods'));
        // On charge le fichier content.xml pour pouvoir effectuer des modifications
        // dans notre fichier open office
        $doc->loadXml('content.xml');

        /* on remplis les champs du document */
        $doc->mergeXmlBlock('block1', $array);
        $doc->mergeXmlBlock('block2', $arrayM);
        $doc->mergeXmlBlock('block3', $arrayD);
        /* On sauvegarde et on ferme le document */
        $doc->saveXml();
        $doc->close();

        // send and remove the document
        // surcharge effectuer, le nom du document peut etre modifier a guise
        $doc->sendResponse(array("filename" => "Tables_Annuelle_" . $date . ".ods"));
        $doc->remove();

        throw new sfStopException;
    }

    /**
     * Cette fonction execute la requête permettant la génération
     * des tables decenale.
     * Elle est appelée par Symfony, et nécessite de
     * recevoir en parrametre un array d'acte.
     *
     * @author Boyer Jimmy
     * @author Flament Guillaume
     * @param sfWebRequest $request
     */
    public function executeTablesDecenale(sfWebRequest $request) {
        $recherche = $request->getParameter("Recherche");
        $date = $recherche["Date"]["year"];


        /* Acte de naissance */
        $naissances = Doctrine_Query::create()
                ->select("*")
                ->from("naissance n")
                ->where("YEAR(n.dateActe) BETWEEN ? AND ?", array($date, $date + 9))
                ->execute();

        $array = $naissances->toArray();

        // Cette boucle va nous permettre de retrouver les enfant de nos actes de
        // Naissance
        $i = 0;
        foreach ($naissances as $naissance) {
            if ($naissance->getEnfant() != null) {
                //$array[$i]["id"] = $naissance->getId();
                $array[$i]["nom"] = $naissance->getEnfant()->getNom();
                $array[$i]["prenom"] = $naissance->getEnfant()->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieunaissance"] = Ville_france::getVilleDepartement($naissance->getEnfant()->getLieuNaissance());
                // Si il s'ajout d'une reconnaissance, on affiche le nom + prénom du père car l'enfant n'est pas encore né,
                // donc pas enregistré. Sinon, on affiche le nom et prénom de la mère.
                // Parfois aucun déclarant n'est enregistré, il faut aussi gérer ce cas sinon des erreurs sont engendrées lors
                // de la génération des tables annuelles ou décénales
            } elseif ($naissance->PereIsPresent()) {
                $pere = $naissance->getPere();
                $array[$i]["nom"] = $pere->getNom();
                $array[$i]["prenom"] = $pere->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieunaissance"] = Ville_france::getVilleDepartement($pere->getLieuNaissance());
            } elseif ($naissance->MereIsPresent()) {
                $mere = $naissance->getMere();
                $array[$i]["nom"] = $mere->getNom();
                $array[$i]["prenom"] = $mere->getPrenom();
                $array[$i]["numeroacte"] = $naissance->getNumeroacte();
                $array[$i]["typeActe"] = $naissance->getTypeActe();
                $array[$i]["dateacte"] = date("d/m/Y", strtotime($naissance->getDateActe()));
                $array[$i]["lieunaissance"] = Ville_france::getVilleDepartement($mere->getLieuNaissance());
            } else {
                die($naissance->getId());
            }
            $i++;
        }
        /* ---------------------- */

        /* Acte de Mariage */
        /* Attention ! La generation doit normalement s'effectuer sur les date des Actes
         * Cependant, lors de l'importation des données, la date de l'acte n'était pas présente
         * c'est pour cela que l'on effectue cette génération sur la date de Mariage
         *
         */
        $mariages = Doctrine_Query::create()
                ->select("*")
                ->from("mariage m")
                ->where("YEAR(m.dateMariage) BETWEEN ? AND ?", array($date, $date + 9))
                ->execute();

        $arrayM = $mariages->toArray();

        $i = 0;
        foreach ($mariages as $mariage) {
            $arrayM[$i]["nomConjoint1"] = $mariage->getConjoint1()->getNom();
            $arrayM[$i]["prenomConjoint1"] = $mariage->getConjoint1()->getPrenom();
            $arrayM[$i]["nomConjoint2"] = $mariage->getConjoint2()->getNom();
            $arrayM[$i]["prenomConjoint2"] = $mariage->getConjoint2()->getPrenom();
            $arrayM[$i]["numeroacte"] = $mariage->getNumeroActe();
            $arrayM[$i]["datemariage"] = date("d/m/Y", strtotime($mariage->getDateMariage()));
            $i++;
        }
        /* ---------------------- */

        /* Acte de Déces */
        $decess = Doctrine_Query::create()
                ->select("*")
                ->from("deces d")
                ->where("YEAR(d.dateActe) BETWEEN ? AND ?", array($date, $date + 9))
                ->execute();

        $arrayD = $decess->toArray();

        $i = 0;
        foreach ($decess as $deces) {
            $arrayD[$i]["nomDefunt"] = $deces->getNomDefunt();
            $arrayD[$i]["prenomDefunt"] = $deces->getPrenomDefunt();
            $arrayD[$i]["numeroActe"] = $deces->getNumeroActe();
            $arrayD[$i]["statutMatrimoniale"] = $deces->getStatutMatrimoniale();
            $arrayD[$i]["nomConjoint"] = $deces->getNomConjoint();
            $arrayD[$i]["dateActe"] = date("d/m/Y", strtotime($deces->getDateActe()));
            $arrayD[$i]["lieuDeces"] = Ville_france::getVilleDepartement($deces->getLieuDeces());
            $i++;
        }

        /* ---------------------- */

        // On crée le document
        $doc = new sfTinyDoc();

        //Si le document est un ods
        $doc->createFrom(array('extension' => 'ods'));
        // On charge le fichier content.xml pour pouvoir effectuer des modifications
        // dans notre fichier open office
        $doc->loadXml('content.xml');

        /* on remplis les champs du document */
        $doc->mergeXmlBlock('block1', $array);
        $doc->mergeXmlBlock('block2', $arrayM);
        $doc->mergeXmlBlock('block3', $arrayD);
        /* On sauvegarde et on ferme le document */
        $doc->saveXml();
        $doc->close();

        // send and remove the document
        // surcharge effectuer, le nom du document peut etre modifier a guise
        $doc->sendResponse(array("filename" => "Tables_Decenale_." . $date . "-" . ($date + 9) . ".ods"));
        $doc->remove();

        throw new sfStopException;
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $utilisateur = $form->save();

            $this->redirect('utilisateur/edit?id=' . $utilisateur->getId());
        }
    }

}
