<?php
class User
{
    public $id;
    private $nom;
    public $prenom;
    private $mdp;
    private $mail;
    private $birth_date;
    private $espace_total;
    private $espace_utilise;
    public $actif;
    public $lastco;
    private $Bdd;  // Objet PDO

    //CONSTRUCTEUR DESTRUCTEUR
    function __construct($mail, $mdp, $nom = NULL, $prenom = NULL, $birth_date = NULL, $espace_total = 5000000, $espace_utilise = 0)
    {
        $this->initBDD();
        if ($this->setLogin($mail)) {
            $this->setMdp($mdp);
            //CONNEXION & INSCRIPTION
            if ($nom == NULL && $prenom == NULL) {
                $this->connect();
            } else if ($prenom != NULL && $nom != NULL) {
                $this->setNom($nom);
                $this->prenom = $prenom;
                $this->mail = $mail;
                $this->birth_date = $birth_date;
                $this->espace_total = $espace_total;
                $this->espace_utilise = $espace_utilise;
                $this->subscribe();
            } else {
                echo "Respecte mon code BOULET ! ";
            }
        } else
            echo "Le Login n'est pas une adresse e-mail !";
    }

    function __destruct()
    {
        unset($this->mdp);
    }

    //GETTERS
    public function getMdp()
    {
        return $this->mdp;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getBirthDate()
    {
        return $this->birth_date;
    }

    public function getEspaceTotal()
    {
        return $this->espace_total;
    }

    public function getEspaceUtilise()
    {
        return $this->espace_utilise;
    }


    //SETTERS
    public function setMdp($pass)
    {
        $this->mdp = $pass;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setDateNaissance($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    public function setEspaceTotal($espace_total)
    {
        $this->espace_total = $espace_total;
    }

    public function setEspaceUtilise($espace_utilise)
    {
        $this->espace_utilise = $espace_utilise;
    }

    public function setLogin($l)
    {
        if (filter_var($l, FILTER_VALIDATE_EMAIL) != FALSE) {
            $this->mail = $l;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function setNom($n)
    {
        $this->nom = strtoupper($n); //uniformise la base de donnée
    }

    // METHODES

    public function subscribe()
    {
        $mail = $_POST['mail'];
        $reqmail = $this->Bdd->prepare("SELECT * FROM user WHERE mail = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();
        if ($mailexist == 0) {

            $this->lastco = date("Y-m-d H:i:s");
            $req = "INSERT INTO user(nom, prenom, birth_date, mail, mdp, espace_total, espace_utilise)
                    VALUES('$this->nom','$this->prenom','$this->birth_date','$this->mail','$this->mdp','$this->espace_total','$this->espace_utilise')";

            // ON EXECUTE LA REQUETE
            $Ores = $this->Bdd->query($req);
            $this->id = $this->Bdd->lastInsertId();
            header('Location: connexion.php');
        } else {
            $_SESSION['errorMail'] = " Adresse mail déjà utilisée ";
            header('Location: inscription.php');
        }
    }

    public function connect()
    {
        $login = $_POST['mail'];
        $pwd = $_POST['mdp']; //sha1()

        // ON PREPARE LA REQUETE
        $req = "SELECT * FROM user WHERE mail= '$login' AND mdp='$pwd'";

        // J'EXECUTE LA REQUETE
        $ORes = $this->Bdd->query($req);

        if ($Usr = $ORes->fetch()) {
            $this->mail = $Usr->mail;
            $this->id = $Usr->id;
            $this->setNom($Usr->nom);
            $this->prenom = $Usr->prenom;
            $this->lastco = $Usr->lastco;
            $this->ouvrirSession();

            header('Location: accueilConnecte.php');
        } else {
            $_SESSION['error'] = "pas d'users ou faux mot de passe";
            header('Location: connexion.php');
        }
    }

    public function ouvrirSession()
    {
        $_SESSION["id"] = $this->id;
        $_SESSION["mail"] = $this->mail;
        $_SESSION["nom"] = $this->nom;
        $_SESSION["prenom"] = $this->prenom;
    }

    private function    initBDD()
    {
        $bdUser = "root"; // Utilisateur de la base de données
        $bdPasswd = ""; // Son mot de passe
        $dbname = "motion_pictures"; // nom de la base de données
        $host = "localhost"; // Hôte
        try {
            $this->Bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $bdUser, $bdPasswd); // SE CONNECTER A LA BDD
            $this->Bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // METTRE LE MODE OBJET PAR DEFAUT
        } catch (PDOException $e) {
            echo ("Erreur : impossible de se connecter à la bdd");
        }
    }


}

