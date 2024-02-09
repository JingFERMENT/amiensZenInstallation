<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Post
{
    private ?int $id_post;
    private string $title;
    private string $content;
    private ?DateTime $published_at;
    private ?DateTime $archived_at;
    private ?DateTime $updated_at;
    private ?DateTime $deleted_at;
    private ?string $photo;
    private ?int $id_subscriber;
    private array $id_categories;

    //*************** ID POST ***************//
    public function getId_post(): ?int
    {
        return $this->id_post;
    }

    public function setId_post(?int $id_post)
    {
        $this->id_post = $id_post;
    }

    //*************** TITLE ***************//
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    //*************** CONTENT ***************//
    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    //*************** PUBLISH AT ***************//
    public function getPublished_at(): ?DateTime
    {
        return $this->published_at;
    }

    public function setPublished_at(?string $published_at)
    {
        $this->published_at = new DateTime($published_at);
    }

    //*************** ARCHIVED AT ***************// 
    public function getArchived_at(): ?DateTime
    {
        return $this->archived_at;
    }

    public function setArchived_at(?string $archived_at)
    {
        $this->archived_at = new DateTime($archived_at);
    }

    //*************** UPDATED AT ***************// 
    public function getUpdated_at(): ?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?string $updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
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

    //*************** PHOTO ***************// 
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo)
    {
        $this->photo = $photo;
    }

    //*************** ID SUBSCRIBER ***************// 

    public function getId_subscriber(): ?int
    {
        return $this->id_subscriber;
    }

    public function setId_subscriber(?int $id_subscriber)
    {
        $this->id_subscriber = $id_subscriber;
    }

    /**
     * 
     * Méthode permettant l'enregistrement d'un nouvel article
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function insert(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant des marqueurs nominatifs
        $sql = 'INSERT INTO `posts` 
                    (`title`, `content`, `photo`, `id_subscriber`) 
                VALUES
                    (:title, :content, :photo, :id_subscriber);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':title', $this->getTitle());
        $sth->bindValue(':content', $this->getContent());
        $sth->bindValue(':photo', $this->getPhoto());
        $sth->bindValue(':id_subscriber', $this->getId_subscriber(), PDO::PARAM_INT);

        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception("Erreur lors de l'enregistrement de de l'article.");
        }

        $postId = $pdo->lastInsertId();

        // Requête pour posts_categories
        $sql2 = 'INSERT INTO `posts_categories` 
        (`id_post`, `id_category`) 
        VALUES
        (:id_post, :id_category);';

        foreach ($this->getId_categories() as $categoryId) {
            $sth2 = $pdo->prepare($sql2);
            $sth2->bindValue(':id_post', $postId, PDO::PARAM_INT);
            $sth2->bindValue(':id_category', $categoryId, PDO::PARAM_INT);
            // Exécution de la requête
            $sth2->execute();

            if ($sth->rowCount() <= 0) {
                throw new Exception("Erreur lors de l'enregistrement du lien entre article et catégorie.");
            }
        }

        return true;
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des articles sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function getAll(): array | false
    {
        $pdo = Database::connect();
        $sql = 'SELECT `posts`.*, `subscribers`.`firstname`, `subscribers`.`lastname`
        from `posts` JOIN `subscribers`
        ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber`';

        $sth = $pdo->query($sql);
        $datas = $sth->fetchAll();

        return $datas;
    }

    /**
     * Get the value of id_categories
     */
    public function getId_categories()
    {
        return $this->id_categories;
    }

    /**
     * Set the value of id_categories
     *
     * @return  self
     */
    public function setId_categories($id_categories)
    {
        $this->id_categories = $id_categories;

        return $this;
    }

    /**
     * Méthode permettant  de récupérer un objet standard avec pour propriétés, les colonnes sélectionnées
     * 
     * @param int $id_post id de l'enregistrement à récupérer
     * 
     * @return object
     */
    public static function get(int $id_post): object|false
    {
        $pdo = Database::connect();
        $sql = 'SELECT `posts`.*, `subscribers`.`firstname`, `subscribers`.`lastname` from `posts` JOIN `subscribers`
        ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber` WHERE `id_post` = :id_post';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_post', $id_post);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.

        if (!$data) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la récupération de l article');
        }

        $sql2 = 'SELECT `id_category` from `posts_categories` WHERE `id_post` = :id_post';
        $sth2 = $pdo->prepare($sql2);
        $sth2->bindValue(':id_post', $id_post);
        $sth2->execute();
        $dataCategories = $sth2->fetchAll();

        $categoryIds = [];
        foreach($dataCategories as $dataCategory) {
            $categoryIds[] = $dataCategory->id_category;
        }

        $data->id_categories = $categoryIds;

        // Retourne la data dans le cas contraire (tout s'est bien passé)
        return $data;
    }

    /**
     * Méthode permettant l'enregistrement la mise à jour d'une article
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function update(): bool
    {
        // Mettre a jour l article
        $pdo = Database::connect();
        $sql = 'UPDATE `posts` SET `title` = :title, `content` = :content, `photo` = :photo WHERE `id_post` = :id_post;';
        $sth = $pdo->prepare($sql);

        $sth->bindValue(':title', $this->getTitle());
        $sth->bindValue(':content', $this->getContent());
        $sth->bindValue(':photo', $this->getPhoto());
        $sth->bindValue(':id_post', $this->getId_post());

        if (!$sth->execute()) {
            throw new Exception('Erreur lors de la mise à jour de l article');
        }

        // Effacer tous les liens article <-> categories
        $sql2 = 'DELETE FROM `posts_categories` WHERE `id_post` = :id_post;';
        $sth2 = $pdo->prepare($sql2);
        $sth2->bindValue(':id_post', $this->getId_post(), PDO::PARAM_INT);
        // Exécution de la requête
        $sth2->execute();

        // Reinserer les liens article <-> categories mis a jour
        $sql3 = 'INSERT INTO `posts_categories` 
        (`id_post`, `id_category`) 
        VALUES
        (:id_post, :id_category);';

        foreach ($this->getId_categories() as $categoryId) {
            $sth3 = $pdo->prepare($sql3);
            $sth3->bindValue(':id_post', $this->getId_post(), PDO::PARAM_INT);
            $sth3->bindValue(':id_category', $categoryId, PDO::PARAM_INT);
            // Exécution de la requête
            $sth3->execute();

            if ($sth3->rowCount() <= 0) {
                throw new Exception("Erreur lors de l'enregistrement du lien entre article et catégorie.");
            }
        }

        return true;
    }
}
