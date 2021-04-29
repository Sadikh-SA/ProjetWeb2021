<?php

    class Chapitre {

        private $titre;
        private $description;
        private $videos;
        private $fichiers;
        private $questionnaire;
        private $dateCreation;
        private $idCours;

        public function __construct($titre="",$description="",$videos="",$fichiers="",$questionnaire="",$dateCreation="",$idCours="")
        {
            $this->titre = $titre;
            $this->description = $description;
            $this->videos = $videos;
            $this->fichiers = $fichiers;
            $this->questionnaire = $questionnaire;
            $this->dateCreation = $dateCreation;
            $this->idCours = $idCours;
        }

        public function getTitre() {
            return $this->titre;
        }
        
        public function SetTitre($newtitre) {
            $this->titre = $newtitre;
        }
        public function getDescription() {
            return $this->description;
        }
        
        public function SetDescription($newdescription) {
            $this->description = $newdescription;
        }
        public function getQuestionnaire() {
            return $this->questionnaire;
        }
        public function SetQuestionnaire($newqcm) {
            $this->questionnaire = $newqcm;
        }
        public function getVideos() {
            return $this->videos;
        }
        public function SetVideos($newvideos) {
            $this->videos = $newvideos;
        }
        public function getFichiers() {
            return $this->fichiers;
        }
        public function SetFichiers($newFichiers) {
            $this->fichiers = $newFichiers;
        }
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }

        public function getCours() {
            return $this->idCours;
        }
        
        public function SetCours($newCours) {
            $this->idCours = $newCours;
        }

    }
?>