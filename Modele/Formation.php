<?php

    class Formation {

        private $titre;
        private $description;
        private $dateCreation;

        public function __construct($titre="",$description="",$dateCreation="")
        {
            $this->titre = $titre;
            $this->description = $description;
            $this->dateCreation = $dateCreation;
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
        public function getDateCreation() {
            return $this->dateCreation;
        }
        
        public function SetDateCreation($newdateCreation) {
            $this->dateCreation = $newdateCreation;
        }
    }
?>