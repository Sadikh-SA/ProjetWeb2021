<?php

    class Questionnaire {

        private $fichiers;
        private $dateCreation;
        private $idChapitre;

        public function __construct($fichiers="",$dateCreation="",$idChapitre="")
        {
            $this->fichiers = $fichiers;
            $this->dateCreation = $dateCreation;
            $this->idChapitre = $idChapitre;
        }

        public function getFichiers() {
            return $this->fichiers;
        }
        
        public function SetFichiers($newfichiers) {
            $this->fichiers = $newfichiers;
        }
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }
        public function getChapitre() {
            return $this->idChapitre;
        }
        
        public function SetChapitre($newidChapitre) {
            $this->idChapitre = $newidChapitre;
        }
    }
?>