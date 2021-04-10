<?php

    class Cours {

        private $titre;
        private $type;
        private $images;
        private $videos;
        private $fichiers;
        private $dateCreation;
        private $idCours;

        public function __construct($titre="",$type="",$images="",$videos="",$fichiers="",$dateCreation="",$idCours)
        {
            $this->titre = $titre;
            $this->type = $type;
            $this->images = $images;
            $this->videos = $videos;
            $this->fichiers = $fichiers;
            $this->dateCreation = $dateCreation;
            $this->idCours = $idCours;
        }

        public function getTitre() {
            return $this->titre;
        }
        
        public function SetTitre($newtitre) {
            $this->titre = $newtitre;
        }
        public function getType() {
            return $this->type;
        }
        
        public function SetType($newtype) {
            $this->type = $newtype;
        }
        public function getImages() {
            return $this->images;
        }
        public function SetImages($newimage) {
            $this->images = $newimage;
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