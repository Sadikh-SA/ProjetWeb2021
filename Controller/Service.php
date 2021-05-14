<?php
class Service
{
    private $pdo;
    public function connexion($db_name = "projetweb2021", $db_user = 'root', $db_pass = 'Moimeme2018', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    public function getPDO()
    {
        if ($this->pdo === null) {
            $conn = new PDO('mysql:host=127.0.0.1;dbname=projetweb2021', 'root', 'Moimeme2018');
            $this->pdo = $conn;
        }
        return $this->pdo;
    }

    //Cette fonction permet de rechercher tous les éléments d'une table
    public function findAll($table)
    {
        $resultat = "SELECT * FROM $table";
        $res = $this->getPDO()->query($resultat);
        return $res;
    }
    //Cette fonction permet de rechercher les éléments en fonction des clés étrangers
    public function findBy($table,$id)
    {
        if ($table == "Questions" || $table == "Forum") {
            $resultat = "SELECT * FROM $table";
        } elseif ($table == "Cours" || $table == "Utilisateur") {
            if ($_SESSION['role']!='User') {
                $resultat = "SELECT * FROM $table";
            }else {
                $resultat = "SELECT * FROM $table where idFormation=$id";
            }
        } elseif ($table == "Chapitre" || $table == "Discussion") {
            $resultat = "SELECT * FROM $table where idCours=$id";     
        }
        return $this->getPDO()->query($resultat);
    }

    //Cette fonction permet de rechercher un élément dans un table
    public function find($table, $id)
    {
        $requete = "select * from $table where id=:id";
        $res = $this->getPDO()->prepare($requete);
        $res->bindParam(":id",$id);
        $res->execute();
        return $res;
    }

    //Cette fonction permet de rechercher un élément dans un table
    public function finds($id)
    {
        $requete = "select * from Utilisateur where mail=:mail";
        $res = $this->getPDO()->prepare($requete);
        $res->bindParam(":mail",$id);
        $res->execute();
        return $res;
    }

    public function longText($valeur,$limite){
        if($valeur && strlen($valeur)>$limite){
            return substr($valeur, 0, $limite).' ... ';
        }
        return $valeur;
    }


    public function add($objet)
    {
        $donnee='';
        if (get_class($objet) == "Utilisateur") {
            $requete = "INSERT INTO Utilisateur (nom, prenom, mail, role, password,dateCreation,idFormation) VALUE (?,?,?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getNom(), $objet->getPrenom(), $objet->getMail(),$objet->getRole(), $objet->getPassword(), $objet->getDateCreation(),$objet->getFormation()));
        }elseif (get_class($objet) == "Cours") {
            $requete = "INSERT INTO Cours (nom, description, image,dateCreation,idFormation) VALUE (?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getNom(), $objet->getDescription(), $objet->getImage(), $objet->getDateCreation(),$objet->getFormation()));
        }elseif (get_class($objet) == "Chapitre") {
            $requete = "INSERT INTO Chapitre (titre, description, videos, fichiers,questionnaire,dateCreation,idCours) VALUE (?,?,?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getTitre(), $objet->getDescription(),$objet->getVideos(), $objet->getFichiers(), $objet->getQuestionnaire(), $objet->getDateCreation(),$objet->getCours()));
        }elseif (get_class($objet) == "Formation") {
            $requete = "INSERT INTO Cours (titre, description,dateCreation) VALUE (?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getTitre(), $objet->getDescription(),$objet->getDateCreation()));
        }elseif (get_class($objet) == "Niveau") {
            $requete = "INSERT INTO Niveau (fichiers,idUtilisateur,idChapitre,dateCreation) VALUE (?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getFichiers(), $objet->getUtilisateur(), $objet->getChapitre(),$objet->getDateCreation()));
        }elseif (get_class($objet) == "Discussion") {
            $requete = "INSERT INTO Discussion (idCours,idUtilisateur,message,dateCreation) VALUE (?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getIdCours(), $objet->getUsers(), $objet->getMessage(),$objet->getDateCreation()));
        }
        return $donnee;
    }

    public function findBoursier($table)
    {
        $requete = "select * from Etudiant, $table where Etudiant.idEtu=$table.idEtu";
        $res = $this->getPDO()->prepare($requete);
        $res->execute();
        return $res;
    }

    public function update($objet , $id, $test)
    {
        $donne = '';
        if ($test == "Profil") {
            $requete = "UPDATE Utilisateur SET nom=:nom, prenom=:prenom, mail=:mail, role=:role,type=:type, password=:password, dateCreation=:ddn where id=:id";
            $res = $this->getPDO()->prepare($requete);
            $donne = $res->execute(array(':nom' => $objet->getNom(), ':prenom' => $objet->getPrenom(),':mail' => $objet->getMail(),':role' => $objet->getRole(),':type' => $objet->getType(), ':password' => $objet->getPassword(),':ddn' => $objet->getDateCreation(),':id' => $id));
        }
        elseif ($test == "Bloquer") {
            $requete = "UPDATE Utilisateur SET type=:type where id=:id";
            $res = $this->getPDO()->prepare($requete);
            $donne = $res->execute(array(':type' => false,':id' => $id));
        }  
        return $donne;
    }

    public function supprimer($table,$id) {
        $requete = "DELETE FROM $table WHERE id=:id";
        $res = $this->getPDO()->prepare($requete);
        $res->execute(array(':id' => $id));
    }
}