<?php

    class Niveau {

        private $pourcentage;
        private $idUtilisateur;
        private $idChapitre;
        private $dateCreation;

        public function __construct($pourcentage="",$idUtilisateur="",$idChapitre="",$dateCreation="")
        {
            $this->pourcentage = $pourcentage;
            $this->idUtilisateur = $idUtilisateur;
            $this->idChapitre = $idChapitre;
            $this->dateCreation = $dateCreation;
        }

        public function getPourcentage() {
            return $this->pourcentage;
        }
        
        public function SetPourcentage($newpourcentage) {
            $this->pourcentage = $newpourcentage;
        }
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }
        public function getUtilisateur() {
            return $this->idUtilisateur;
        }
        
        public function SetUtilisateur($newidUtilisateur) {
            $this->idUtilisateur = $newidUtilisateur;
        }
        public function getChapitre() {
            return $this->idChapitre;
        }
        
        public function SetChapitre($newidChapitre) {
            $this->idChapitre = $newidChapitre;
        }
    }
?>