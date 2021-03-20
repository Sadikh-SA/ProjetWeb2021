<?php

    class Forum {

        private $nom;
        private $prenom;
        private $tel;
        private $mail;
        private $role;

        public function __construct($nom="",$prenom="",$tel="",$mail="",$role)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->tel = $tel;
            $this->mail = $mail;
            $this->role = $role;
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
        public function getTel() {
            return $this->tel;
        }
        
        public function SetTel($newtel) {
            $this->tel = $newtel;
        }

        public function getRole() {
            return $this->role;
        }
        
        public function SetRole($newrole) {
            $this->role = $newrole;
        }

    }
?>