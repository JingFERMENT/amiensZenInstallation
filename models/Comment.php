<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Comment
{
    private ?int $id_comment;
    private string $description;
    private ?DateTime $created_at;
    private ?DateTime $deleted_at;
    private ?DateTime $validated_at;
    private ?int $id_post;
    private int $id_subscriber;

    //*************** ID COMMENT ***************//
    public function getId_comment(): ?int
    {
        return $this->id_comment;
    }

    public function setId_comment(?int $id_comment)
    {
        $this->id_post = $id_comment;
    }

    //*************** DESCRIPTION ***************//
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    //*************** CREATED AT ***************//
    public function getCreated_at(): ?DateTime
    {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at)
    {
        $this->created_at = new DateTime($created_at);
    }

    //*************** VALIDATED AT ***************// 
    public function getValidated_at(): ?DateTime
    {
        return $this->validated_at;
    }

    public function setValidated_at(?string $validated_at)
    {
        $this->validated_at = new DateTime($validated_at);
    }

    //*************** DELETED AT ***************// 
    public function getDeleted_at(): ?DateTime
    {
        return $this->deleted_at;
    }

    public function setDeleted_at(?string $deleted_at)
    {
        $this->deleted_at = new DateTime($deleted_at);
    }

    //*************** ID POST ***************// 

    public function getId_post(): ?int
    {
        return $this->id_post;
    }

    public function setId_post(?int $id_post)
    {
        $this->id_post = $id_post;
    }

    //*************** ID SUBSCRIBER ***************// 

    public function getId_subscriber(): int
    {
        return $this->id_subscriber;
    }

    public function setId_subscriber(int $id_subscriber)
    {
        $this->id_subscriber = $id_subscriber;
    }


    /**
     * Méthode permettant l'enregistrement d'un nouveau commentaire
     * 
     * @return bool
     */
    public function insert(): bool
    {
        $pdo = Database::connect();

        // Requête contenant un marqueur nominatif
        $sql = 'INSERT INTO `comments` (`description`, `id_post`, `id_subscriber`) VALUES (:description, :id_post, :id_subscriber);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':description', $this->getDescription());
        $sth->bindValue(':id_post', $this->getId_post());
        $sth->bindValue(':id_subscriber', $this->getId_subscriber());

        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de l\'enregistrement du commentaire');
        } else {
            return true;
        }
    }

    /**
     * 
     * Méthode permettant de récupérer la liste de tous les commentaires sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function getAll(): array | false
    {
        $pdo = Database::connect();
        $sql = 'SELECT `comments`.*, `subscribers`.`firstname`, `subscribers`.`lastname`
        from `comments` JOIN `subscribers`
        ON `comments`.`id_subscriber` = `subscribers`.`id_subscriber`';

        $sth = $pdo->query($sql);
        $datas = $sth->fetchAll();

        return $datas;
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des commentaires d'un article
     * 
     * @return array Tableau d'objets
     */
    public static function getAllCommentsForOnePost($id_post): array | false
    {
        $pdo = Database::connect();
        $sql = 'SELECT `comments`.*, `subscribers`.`firstname`, `subscribers`.`lastname`,
        `posts`.`id_post`
        from `comments` 
        JOIN `subscribers` ON `comments`.`id_subscriber` = `subscribers`.`id_subscriber`
        JOIN `posts` ON `posts`.`id_post` = `comments`.`id_post`
        WHERE `comments`.`id_post` = :id_post';

        $sth = $pdo->prepare($sql);
        
        $sth->bindValue(':id_post', $id_post);

        $sth->execute();
        
        $datas = $sth->fetchAll();

        return $datas;
    }

    /**
     * 
     * Méthode permettant la suppression d'un commentaire
     * 
     * @param int $id_commentaire
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public static function delete(int $id_comment): bool
    {
        $pdo = Database::connect();

        // Effacer tous les liens article <-> categories
        $sql = 'DELETE FROM `comments` WHERE `id_comment` = :id_comment;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_comment', $id_comment, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function validate(string $id_comment): bool
    {
        $pdo = Database::connect();
        $sql = 'UPDATE `comments` SET `validated_at` = NOW() WHERE id_comment =:id_comment;';

        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_comment', $id_comment);
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Votre commentaire n\'a pas été validé.');
        } else {
            // Retourne true quand tout s'est bien passé
            return true;
        }
    }
}
