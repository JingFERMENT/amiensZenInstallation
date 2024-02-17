<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Subscriber
{

    private int $id_subscriber;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $password;
    private ?DateTime $birthdate;
    private ?string $phone;
    private ?string $profile_picture;
    private ?DateTime $subscribed_at;
    private DateTime $updated_at;
    private DateTime $deleted_at;
    private ?bool $is_admin;
    private ?string $family_situation;

    // méthode construct initization avec null 
    // public function __construct()
    // {
    //     $this->id_subscriber;
    //     $this->lastname;
    //     $this->firstname;
    //     $this->email;
    //     $this->password;
    //     $this->birthdate;
    //     $this->phone;
    //     $this->profile_picture;
    //     $this->subscribed_at;
    //     $this->updated_at;
    //     $this->deleted_at;
    //     $this->is_admin;
    //     $this->family_situation;
    // }


    //*************** ID SUBSCRIBER ***************//
    public function getId_subscriber(): ?int
    {
        return $this->id_subscriber;
    }

    public function setId_subscriber(int $id_subscriber)
    {
        $this->id_subscriber = $id_subscriber;
    }

    //*************** LASTNAME ***************//
    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    //*************** FIRSTNAME ***************//
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    //*************** EMAIL ***************//
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    //*************** PASSWORD ***************// 
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    //*************** BIRTHDATE ***************// 

    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate)
    {
        $this->birthdate = new DateTime($birthdate);
    }

    //*************** PHONE ***************// 

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    //*************** PROFILE PICTURE ***************// 
    public function getProfile_picture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfile_picture(?string $profile_picture)
    {
        $this->profile_picture = $profile_picture;
    }

    //*************** SUBSCRIBED_AT ***************// 
    public function getSubscribed_at(): DateTime
    {
        return $this->subscribed_at;
    }

    public function setSubscribed_at(string $subscribed_at)
    {
        $this->subscribed_at = new DateTime($subscribed_at);
    }

    //*************** SUBSCRIBED_AT ***************// 
    public function getUpdated_at(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }

    //*************** DELETED_AT ***************// 
    public function getDeleted_at(): DateTime
    {
        return $this->deleted_at;
    }

    public function setDeleted_at(string $deleted_at)
    {
        $this->deleted_at = new DateTime($deleted_at);
    }

    //*************** IS_ADMIN***************// 
    public function getIs_admin(): bool
    {
        return $this->is_admin;
    }

    public function setIs_admin(bool $is_admin)
    {
        $this->is_admin = $is_admin;
    }

    //*************** FAMILY_SITUATION ***************// 
    public function getFamily_situation(): string
    {
        return $this->family_situation;
    }

    public function setFamily_situation(string $family_situation)
    {
        $this->family_situation = $family_situation;
    }

    /**
     * Méthode permettant l'enregistrement d'un nouvel abonné
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function insert(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant des marqueurs nominatifs
        $sql = 'INSERT INTO `subscribers` 
                    (`lastname`, `firstname`, `email`, `password`) 
                VALUES
                    (:lastname, :firstname, :email, :password);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':email', $this->getEmail());
        $sth->bindValue(':password', $this->getPassword());

        // email unique dans la base des données
        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception("Erreur lors de l'enregistrement de l'abonné.");
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    /**
     * Méthode permettant la mise à jour d'un abonné
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function update(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        $sql = 'UPDATE `subscribers`
            SET `lastname` = :lastname, `firstname` = :firstname, `email` = :email,
            `birthdate` = :birthdate, `phone` = :phone, 
            `family_situation` = :family_situation, `profile_picture` = :profile_picture 
            WHERE `id_subscriber` = :id_subscriber;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':email', $this->getEmail());
        $sth->bindValue(':birthdate', ($this->getBirthdate())->format('Y-m-d'));
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':family_situation', $this->getFamily_situation());
        $sth->bindValue(':profile_picture', $this->getProfile_picture());
        $sth->bindValue(':id_subscriber', $this->getId_subscriber(), PDO::PARAM_INT);

        
        $sth->execute();
        
        if (!$sth->execute()) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la mise à jour de l\'abonné');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des abonnés sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function getAll(): array | false
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `subscribers` ORDER by `lastname`';
        $sth = $pdo->query($sql);
        $datas = $sth->fetchAll();
        return $datas;
    }

    /**
     * 
     * Méthode permettant  de récupérer un objet standard avec pour propriétés, les colonnes sélectionnées
     * 
     * @param int $id_subscriber
     * 
     * @return object
     */
    public static function get(int $id_subscriber): object|false
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `subscribers` WHERE `id_subscriber` = :id_subscriber';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_subscriber', $id_subscriber);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la récupération de l\'abonné');
        } else {
            // Retourne la data dans le cas contraire (tout s'est bien passé)
            return $data;
        }
    }

    /**
     * 
     * Méthode permettant la suppression d'un abonné
     * 
     * @param int $id_subscriber
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public static function delete(int $id_subscriber): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant des marqueurs nominatifs
        $sql = 'DELETE FROM `subscribers` WHERE `id_subscriber` = :id_subscriber;';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_subscriber', $id_subscriber);
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception("Erreur lors de la suppression de l'abonné");
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }


    // méthode getByEmail 
    public static function getByEmail(string $email): object|false
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        $sql = 'SELECT * from `subscribers` WHERE `email` = :email';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':email', $email);

        // Exécution de la requête qui retourne true ou false
        $sth->execute();

        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la récupération de l\'abonné');
        } else {
            // Retourne la data dans le cas contraire (tout s'est bien passé)
            return $data;
        }
    }


    /**
     * Méthode permettant de savoir si un email existe déjà
     * 
     * @param mixed $email
     * 
     * @return bool
     */
    public static function isExist(string $email): bool
    {
        $pdo = Database::connect();

        $sql = 'SELECT COUNT(*) AS `nbcolumn` FROM `subscribers` WHERE `email` = :email;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':email', $email);

        $sth->execute();

        $result = $sth->fetchColumn();

        return $result > 0;
    }

    // envoie de l'email quand l'abonné a confirmé son email pour valider son compte
    public static function confirm(string $email): bool
    {
        $pdo = Database::connect();
        $sql = 'UPDATE `subscribers` SET `confirmed_at` = NOW() WHERE email=:email;';

        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':email', $email);
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Nous n\'avons pas reconnu votre email');
        } else {
            // Retourne true quand tout s'est bien passé
            return true;
        }
    }
}
