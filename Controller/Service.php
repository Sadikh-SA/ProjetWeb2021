<?php
class Service
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
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
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=projetweb2021', 'root', 'Moimeme2018');
            $this->pdo = $pdo;
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
    public function findBy($table,$id=null)
    {
        if ($table == "Questions" || "Forum") {
            $resultat = "SELECT * FROM $table";
            $res = $this->getPDO()->query($resultat);
            return $res;
        } elseif ($table == "Cours" || "Utilisateur") {
            $resultat = "SELECT * FROM $table where $table.idFormation=$id";
            $res = $this->getPDO()->query($resultat);
            return $res;
        } elseif ($table == "Chapitre") {
            $resultat = "SELECT * FROM $table where $table.idCours=$id";
            $res = $this->getPDO()->query($resultat);
            return $res;
        }
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

    public function longText($valeur,$limite){
        if($valeur && strlen($valeur)>$limite){
            return substr($valeur, 0, $limite).' ... ';
        }
        return $valeur;
    }


    public function add($objet)
    {
        if (get_class($objet) == "Utilisateur") {
            $requete = "INSERT INTO Utilisateur (nom, prenom, mail, role, password,dateCreation,idFormation) VALUE (?,?,?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getNom(), $objet->getPrenom(), $objet->getMail(),$objet->getRole(), $objet->getPassword(), $objet->getDateCreation(),$objet->getFormation()));
            return $donnee;
        }elseif (get_class($objet) == "Cours") {
            $requete = "INSERT INTO Cours (nom, description, image,dateCreation,idFormation) VALUE (?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getNom(), $objet->getDescription(), $objet->getImage(), $objet->getDateCreation(),$objet->getFormation()));
            return $donnee;
        }elseif (get_class($objet) == "Chapitre") {
            $requete = "INSERT INTO Chapitre (titre, type, images, videos, fichiers,dateCreation,idCous) VALUE (?,?,?,?,?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getTitre(), $objet->getType(), $objet->getImages(),$objet->getVideos(), $objet->getFichiers(), $objet->getDateCreation(),$objet->getCours()));
            return $donnee;
        }elseif (get_class($objet) == "Formation") {
            $requete = "INSERT INTO Cours (titre, description,dateCreation) VALUE (?,?,?)";
            $res = $this->getPDO()->prepare($requete);
            $donnee = $res->execute(array($objet->getTitre(), $objet->getDescription(),$objet->getDateCreation()));
            return $donnee;
        }
    }

    public function findBoursier($table)
    {
        $requete = "select * from Etudiant, $table where Etudiant.idEtu=$table.idEtu";
        $res = $this->getPDO()->prepare($requete);
        $res->execute();
        //$donnee = $res->fetch(pdo::FETCH_ASSOC);
        return $res;
    }

    public function update(Utilisateur $objet , $id)
    {
        $requete = "UPDATE Etudiant SET matricule=:matricule, nom=:nom, prenom=:prenom, mail=:mail, password=:password, ddn=:ddn where matricule=:matricule1";
        $res = $this->getPDO()->prepare($requete);
        $donne = $res->execute(array(':nom' => $objet->getNom(), ':prenom' => $objet->getPrenom(), ':password' => $objet->getPassword(), ':mail' => $objet->getMail(),':role' => $objet->getRole(),  ':ddn' => $objet->getDateCreation()));
        //var_dump($donne);
        
        $pre = $this->getPDO()->prepare("SELECT id from Utilisateur where id=:id");
        $y = $pre->execute(array(':id' => $id));
        // if (get_class($objet) == "NonBoursier") {

        //     $pres = $this->getPDO()->prepare("select * from Loger where Loger.idEtu=:idEtu");
        //     $moi = $pres->execute(array(':idEtu' => $y));
        //     $log=$moi;
        //     while ($row = $pre->fetch()) {
        //         $log = $row['idEtu'];
        //         //break;
        //     }
        //     ////var_dump($log);
            
        //     $pre = $this->getPDO()->prepare("select * from Boursier where Boursier.idEtu=:idEtu");
        //     $zx = $pre->execute(array(':idEtu' => $y));
        //     $z=$zx;
        //     while ($row = $pre->fetch()) {
        //         $z = $row['idEtu'];
        //         //break;
        //     }
        //     ////var_dump($z);

        //     if ($z!=0 || $z!=NULL) {
        //         if ($log!=null || $log!=0) {
        //             $requete = "DELETE FROM Loger where idEtu=:idEtu";
        //             $stmt = $this->getPDO()->prepare($requete);
        //             $resu = $stmt->execute(array(':idEtu' =>$log));
        //             ////var_dump($resu);
        //         }
        //         $requete = "DELETE FROM Boursier where idEtu=:idEtu";
        //         $stmt = $this->getPDO()->prepare($requete);
        //         $resu = $stmt->execute(array(':idEtu' =>$z));
        //         ////var_dump($resu);

        //         $requete = "INSERT INTO NonBoursier SET idEtu=:idEtu, Adresse=:Adresse";
        //         $res = $this->getPDO()->prepare($requete);
        //         $donnee = $res->execute(array(':idEtu' => $y, ':Adresse' => $objet->getAdresse()));
        //         return $donnee;
        //     } else {
        //         $pre = $this->getPDO()->prepare("select * from NonBoursier where NonBoursier.idEtu=:idEtu");
        //         $zx = $pre->execute(array(':idEtu' => $y));
        //         $z=$zx;
        //         while ($row = $pre->fetch()) {
        //             $z = $row['idnob'];
        //             //break;
        //         }
        //         ////var_dump($z);
        //         if ($zx) {
        //             $requete = "UPDATE NonBoursier SET idEtu=:idEtu, Adresse=:Adresse where idnob=:idnob";
        //             $res = $this->getPDO()->prepare($requete);
        //             $donne = $res->execute(array(':idnob' => $z, ':idEtu' => $y, ':Adresse' => $objet->getAdresse()));
        //             ////var_dump($donne);
        //         }   
        //     }
        // }elseif (get_class($objet) == "Boursier") {

        //    /* $pres = $this->getPDO()->prepare("select * from Loger where Loger.idEtu=:idEtu");
        //     $moi = $pres->execute(array(':idEtu' => $y));
        //     $log=$moi;
        //     while ($row = $pre->fetch()) {
        //         $log = $row['idEtu'];
        //         //break;
        //     }
        //     //var_dump($log);*/
            
        //     $pre = $this->getPDO()->prepare("select * from NonBoursier where NonBoursier.idEtu=:idEtu");
        //     $zx = $pre->execute(array(':idEtu' => $y));
        //     $z=$zx;
        //     while ($row = $pre->fetch()) {
        //         $z = $row['idEtu'];
        //         //break;
        //     }
        //     //var_dump($z);

        //     $pres = $this->getPDO()->prepare("select * from Loger where Loger.idEtu=:idEtu");
        //     $moi = $pres->execute(array(':idEtu' => $y));
        //     $log=$moi;
        //     while ($row = $pre->fetch()) {
        //         $log = $row['idEtu'];
        //         //break;
        //     }
        //     //var_dump($log);

        //     if ($z!=0 || $z!=NULL) {
        //         $requete = "DELETE FROM NonBoursier where idEtu=:idEtu";
        //         $stmt = $this->getPDO()->prepare($requete);
        //         $resu = $stmt->execute(array(':idEtu' =>$z));
        //         //var_dump($resu);

        //         $pre1 = $this->getPDO()->prepare("select * from Situation where libelle=:idlibelle");
        //         $xy = $pre1->execute(array(':idlibelle' => $objet->getLibelle()));
        //         $ter=$xy;
        //         while ($row = $pre->fetch()) {
        //             $ter = $row['idtype'];
        //             //break;
        //         }
        //         //var_dump($ter);

        //         $requete = "INSERT INTO Boursier (idEtu,idtype) VALUE (?,?)";
        //         $res = $this->getPDO()->prepare($requete);
        //         $res->execute(array($y, $ter));

        //     }else{

        //         if($log!=0 || $log!=NULL) {
        //             $requete = "DELETE FROM Loger where idEtu=:idEtu";
        //             $stmt = $this->getPDO()->prepare($requete);
        //             $resu = $stmt->execute(array(':idEtu' =>$log));
        //             //var_dump($resu);
        //         }
        //         $pre = $this->getPDO()->prepare("select * from Boursier where Boursier.idEtu=:idEtu");
        //         $zx = $pre->execute(array(':idEtu' => $y));
        //         $z=$zx;
        //         while ($row = $pre->fetch()) {
        //             $z = $row['idbour'];
        //             //break;
        //         }
        //         //var_dump($z);

        //         $pre1 = $this->getPDO()->prepare("select * from Situation where libelle=:idlibelle");
        //         $xy = $pre1->execute(array(':idlibelle' => $objet->getLibelle()));
        //         $ter=$xy;
        //         while ($row = $pre->fetch()) {
        //             $ter = $row['idtype'];
        //             //break;
        //         }
        //         //var_dump($ter);
                
        //         if ($zx) {
        //             $requete = "UPDATE Boursier SET idbour=:idbour, idEtu=:idEtu, idtype=:idtype  where idbour=:idbour";
        //             $res = $this->getPDO()->prepare($requete);
        //             $donne = $res->execute(array(':idbour' => $z, ':idEtu' => $y, ':idtype' => $ter));
        //             //var_dump($donne);
        //         }
        //     }
        // }
        // elseif (get_class($objet) == "Loger") {

        //     $pre = $this->getPDO()->prepare("select * from NonBoursier where NonBoursier.idEtu=:idEtu");
        //     $zx = $pre->execute(array(':idEtu' => $y));
        //     $z=$zx;
        //     while ($row = $pre->fetch()) {
        //         $z = $row['idEtu'];
        //         //break;
        //     }
        //     //var_dump($z);
            

        //     if ($z!=0 || $z!=NULL) {
        //         $requete = "DELETE FROM NonBoursier where idEtu=:idEtu";
        //         $stmt = $this->getPDO()->prepare($requete);
        //         $resu = $stmt->execute(array(':idEtu' =>$z));
        //         //var_dump($resu);

        //         $pre1 = $this->getPDO()->prepare("select * from Situation where libelle=:idlibelle");
        //         $xy = $pre1->execute(array(':idlibelle' => $objet->getLibelle()));
        //         $ter=$xy;
        //         while ($row = $pre1->fetch()) {
        //             $ter = $row['idtype'];
        //             //break;
        //         }
        //         //var_dump($ter);

        //         $requete = "INSERT INTO Boursier (idEtu,idtype) VALUE (?,?)";
        //         $res = $this->getPDO()->prepare($requete);
        //         $res->execute(array($y, $ter));

        //         $res = $this->getPDO()->prepare("select idbour from Boursier order by idEtu DESC");
        //         $idboursier = $res->execute(array());
        //         while ($row = $res->fetch()) {
        //             $idboursier = $row['idbour'];
        //             break;
        //         }

        //         ////var_dump($idboursier);

        //         $res = $this->getPDO()->prepare("select idbat from Batiment where numbat=:numbat");
        //         $idbatiment = $res->execute(array(':numbat' => $objet->getBatiment()));

        //         while ($row = $res->fetch()) {
        //             $idbatiment = $row['idbat'];
        //             break;
        //         }

        //         ////var_dump($idboursier);

        //         $res = $this->getPDO()->prepare("select idcham from Chambre where numcham=:numcham and idbat=:idbat");
        //         $idchambre = $res->execute(array(':numcham' => $objet->getChambre(), ':idbat' => $idbatiment));

        //         while ($row = $res->fetch()) {
        //             $idchambre = $row['idcham'];
        //             break;
        //         }

        //         ////var_dump($idchambre);

        //         $requete = "INSERT INTO Loger (idbour,idEtu, idcham) VALUE (?,?,?)";
        //         $res = $this->getPDO()->prepare($requete);
        //         $donnee = $res->execute(array($idboursier, $y, $idchambre));
        //         ////var_dump($donnee);

        //         return $donnee;

        //     }else {
        //         $pres = $this->getPDO()->prepare("select * from Loger where Loger.idEtu=:idEtu");
        //         $moi = $pres->execute(array(':idEtu' => $y));
        //         $log=$moi;
        //         while ($row = $pre->fetch()) {
        //             $log = $row['idEtu'];
        //             //break;
        //         }
        //         //var_dump($log);

        //         if ($log!=0 || $log != NULL) {
        //             $pre = $this->getPDO()->prepare("select * from Boursier where Boursier.idEtu=:idEtu");
        //             $zx = $pre->execute(array(':idEtu' => $y));
        //             $z=$zx;
        //             while ($row = $pre->fetch()) {
        //                 $z = $row['idbour'];
        //                 //break;
        //             }
        //             //var_dump($z);

        //             $pre1 = $this->getPDO()->prepare("select * from Situation where libelle=:idlibelle");
        //             $xy = $pre1->execute(array(':idlibelle' => $objet->getLibelle()));
        //             $ter=$xy;
        //             while ($row = $pre1->fetch()) {
        //                 $ter = $row['idtype'];
        //                 //break;
        //             }
        //             //var_dump($ter);
        //             if ($zx) {
        //                 $requete = "UPDATE Boursier SET idbour=:idbour, idEtu=:idEtu, idtype=:idtype  where idbour=:idbour";
        //                 $res = $this->getPDO()->prepare($requete);
        //                 $donne = $res->execute(array(':idbour' => $z, ':idEtu' => $y, ':idtype' => $ter));
        //                 //var_dump($donne);
        //             }

        //             $res = $this->getPDO()->prepare("select * from Batiment where numbat=:numbat");
        //             $don = $res->execute(array(':numbat' => $objet->getBatiment()));
        //             $idbat=$don;
        //             while ($row = $res->fetch()) {
        //                 $idbat = $row['idbat'];
        //                 //break;
        //             }
        //             //var_dump($idbat);

        //             $pre2 = $this->getPDO()->prepare("select * from Chambre where numcham=:numcham AND idbat=:idbat");
        //             $xyz = $pre2->execute(array(':numcham' => $objet->getChambre(), ':idbat' => $idbat));
        //             $terre=$xyz;
        //             while ($row = $pre2->fetch()) {
        //                 $terre = $row['idcham'];
        //                 //break;
        //             }
        //             //var_dump($terre);

        //             if ($zx) {
        //                 $requete = "UPDATE Loger SET idbour=:idbour, idEtu=:idEtu, idcham=:idcham  where idbour=:idbour";
        //                 $res = $this->getPDO()->prepare($requete);
        //                 $donne = $res->execute(array(':idbour' => $z, ':idEtu' => $y, ':idcham' => $terre));
        //                 //var_dump($donne);
        //             }
        //         }
        //         else {
        //             $pre = $this->getPDO()->prepare("select * from Boursier where Boursier.idEtu=:idEtu");
        //             $zx = $pre->execute(array(':idEtu' => $y));
        //             $z=$zx;
        //             while ($row = $pre->fetch()) {
        //                 $z = $row['idbour'];
        //                 //break;
        //             }
        //             //var_dump($z);

        //             $pre1 = $this->getPDO()->prepare("select * from Situation where libelle=:idlibelle");
        //             $xy = $pre1->execute(array(':idlibelle' => $objet->getLibelle()));
        //             $ter=$xy;
        //             while ($row = $pre1->fetch()) {
        //                 $ter = $row['idtype'];
        //                 //break;
        //             }
        //             //var_dump($ter);
        //             if ($zx) {
        //                 $requete = "UPDATE Boursier SET idbour=:idbour, idEtu=:idEtu, idtype=:idtype  where idbour=:idbour";
        //                 $res = $this->getPDO()->prepare($requete);
        //                 $donne = $res->execute(array(':idbour' => $z, ':idEtu' => $y, ':idtype' => $ter));
        //                 //var_dump($donne);
        //             }

        //             $res = $this->getPDO()->prepare("select * from Batiment where numbat=:numbat");
        //             $don = $res->execute(array(':numbat' => $objet->getBatiment()));
        //             $idbat=$don;
        //             while ($row = $res->fetch()) {
        //                 $idbat = $row['idbat'];
        //                 //break;
        //             }
        //             //var_dump($idbat);

        //             $pre2 = $this->getPDO()->prepare("select * from Chambre where numcham=:numcham AND idbat=:idbat");
        //             $xyz = $pre2->execute(array(':numcham' => $objet->getChambre(), ':idbat' => $idbat));
        //             $terre=$xyz;
        //             while ($row = $pre2->fetch()) {
        //                 $terre = $row['idcham'];
        //                 //break;
        //             }
        //             //var_dump($terre);

        //             if ($zx) {
        //                 $requete = "INSERT INTO Loger (idbour=:idbour ,idEtu=:idEtu, idcham=:idcham  VALUES(?,?,?)";
        //                 $res = $this->getPDO()->prepare($requete);
        //                 $donne = $res->execute(array($z, $y,$terre));
        //                 //var_dump($donne);
        //             }
        //         }
        //     }
        // }
    }

    public function supprimer($matricule) {
        $requete = "DELETE FROM Etudiant WHERE matricule=:matricule";
        $res = $this->getPDO()->prepare($requete);
        $res->execute(array(':matricule' => $matricule));
    }
}