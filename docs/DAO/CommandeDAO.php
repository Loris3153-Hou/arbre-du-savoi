<?php

include_once(__DIR__.'/../models/Commande.php');

class CommandeDAO
{

    public function creerCommande($tmp) {

        $commande = new \models\Commande();

        $commande->setIdCommande($tmp['id_commande']);
        $commande->setDateCommande($tmp['date_commande']);
        $commande->setIdUtilisateur($tmp['id_utilisateur']);

        return $commande;
    }

    public function lireRequete($sql, $arguments) {

        require 'DAO.php';

        $bdd = new PDO("mysql:host=localhost;dbname=$db_name",$user,$pass);
        $rs = $bdd->prepare($sql);
        $rs->execute($arguments);

        $listCommande = array();
        while ($tmp = $rs->fetch()) {
            $commande = $this->creerCommande($tmp);
            array_push($listCommande, $commande);
        }
        return $listCommande;
    }

    public function getToutesLesCommandes(){
        $sql = "SELECT * FROM COMMANDE;";
        $argument = array();
        return $this->lireRequete($sql, $argument);
    }

    public function getCommandeParUtilisateur($idUtilisateur){
        $sql = "SELECT COMMANDE.* FROM COMMANDE INNER JOIN UTILISATEUR ON COMMANDE.id_utilisateur = UTILISATEUR.id_utilisateur WHERE COMMANDE.id_utilisateur = ? ;";
        $argument = array();
        array_push($argument, $idUtilisateur);
        return $this->lireRequete($sql, $argument);
    }

}