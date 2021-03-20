<?php

    class Utilisateur {

        private $nom;
        private $prenom;
        private $mail;
        private $password;
        private $role;
        private $dateCreation;
        private $idFormation;

        public function __construct($nom,$prenom,$mail,$role,$password,$dateCreation,$idFormation)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->password = $password;
            $this->mail = $mail;
            $this->role = $role;
            $this->dateCreation = $dateCreation;
            $this->idFormation = $idFormation;
        }

        public function getNom() {
            return $this->nom;
        }
        
        public function SetNom($newnom) {
            $this->nom = $newnom;
        }
        public function getPrenom() {
            return $this->prenom;
        }
        
        public function SetPrenom($newprenom) {
            $this->prenom = $newprenom;
        }
        public function getMail() {
            return $this->mail;
        }
        
        public function SetMail($newmail) {
            $this->mail = $newmail;
        }
        public function getPassword() {
            return $this->password;
        }
        
        public function SetPassword($newpassword) {
            $this->password = $newpassword;
        }

        public function getRole() {
            return $this->role;
        }
        
        public function SetRole($newrole) {
            $this->role = $newrole;
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