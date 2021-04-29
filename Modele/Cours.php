<?php

    class Cours {

        private $nom;
        private $description;
        private $image;
        private $dateCreation;
        private $idFormation;

        public function __construct($nom="",$description="",$image="",$dateCreation="",$idFormation="")
        {
            $this->nom = $nom;
            $this->description = $description;
            $this->image = $image;
            $this->dateCreation = $dateCreation;
            $this->idFormation = $idFormation;
        }

        public function getNom() {
            return $this->nom;
        }
        
        public function SetNom($newnom) {
            $this->nom = $newnom;
        }
        public function getDescription() {
            return $this->description;
        }
        
        public function SetDescription($newdescription) {
            $this->description = $newdescription;
        }
        public function getImage() {
            return $this->image;
        }
        
        public function SetImages($newimage) {
            $this->image = $newimage;
        }
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }

        public function getFormation() {
            return $this->idFormation;
        }
        
        public function SetFormation($newFormation) {
            $this->idFormation = $newFormation;
        }

    }
?>