<?php

    class Discussion {

        private $idCours;
        private $dateCreation;
        private $message;
        private $idUtilisateur;

        public function __construct($idCours="",$idUtilisateur="",$message="",$dateCreation="")
        {
            $this->idCours = $idCours;
            $this->idUtilisateur = $idUtilisateur;
            $this->message = $message;
            $this->dateCreation = $dateCreation;
        }

        public function getIdCours() {
            return $this->idCours;
        }
        
        public function SetIdCours($newidCours) {
            $this->idCours = $newidCours;
        }
        public function getMessage() {
            return $this->message;
        }
        
        public function SetMessage($newmessage) {
            $this->message = $newmessage;
        }
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }
        public function getUsers() {
            return $this->idUtilisateur;
        }
        
        public function SetUsers($newidUtilisateur) {
            $this->idUtilisateur = $newidUtilisateur;
        }
    }
?>