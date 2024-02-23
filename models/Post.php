<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Post
{
    private ?int $id_post;
    private string $title;
    private string $content;
    private ?DateTime $published_at;
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

    //*************** ID CATEGORIES ***************// 
    public function getId_categories()
    {
        return $this->id_categories;
    }


    public function setId_categories($id_categories)
    {
        $this->id_categories = $id_categories;
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
    public static function getAll(bool $isArchived = false): array | false
    {
        $pdo = Database::connect();

        //condition pour archivage
        $archive = $isArchived ? 'IS NOT NULL;' : 'IS NULL;';

        $sql = 'SELECT `posts`.*, `subscribers`.`firstname`, `subscribers`.`lastname`
        from `posts` JOIN `subscribers`
        ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber`
        WHERE `posts`.`deleted_at` ' . $archive;

        $sth = $pdo->query($sql);

        $sth->execute();

        $datas = $sth->fetchAll();

        return $datas;
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des articles sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function getAllPosts(int $id_category = 0, int $offset = 0): array | false
    {
        $pdo = Database::connect();

        $sortCategory = ($id_category != 0) ? " AND `posts_categories`.`id_category`= :id_category"
            : " AND `posts_categories`.`id_category` != 22";

        $sql = 'SELECT `posts`.*, 
        `subscribers`.`firstname`, `subscribers`.`lastname`
        FROM `posts` 
        JOIN `subscribers` ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber`
        JOIN `posts_categories` ON `posts`.`id_post` = `posts_categories`.`id_post`
        WHERE `posts`.`deleted_at` IS NULL ' .
            $sortCategory .
            ' LIMIT ' . PER_PAGE . ' OFFSET :offset;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($id_category != 0) {
            $sth->bindValue(':id_category', $id_category, PDO::PARAM_INT);
        }

        $sth->execute();

        $datas = $sth->fetchAll();

        return $datas;
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des articles sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function searchPosts(string $keywords = null): array | false
    {
        $pdo = Database::connect();

        $sql = 'SELECT `posts`.*, 
        `subscribers`.`firstname`, `subscribers`.`lastname`
        from `posts` 
        JOIN `subscribers` ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber`
        JOIN `posts_categories` ON `posts`.`id_post` = `posts_categories`.`id_post`
        JOIN `categories` ON `categories`.`id_category` = `posts_categories`.`id_category`
        WHERE (`posts`.`title` LIKE :keywords OR 
        `posts`.`content` LIKE :keywords OR 
        `categories`.`name` LIKE :keywords OR 
        `subscribers`.`lastname` LIKE :keywords OR 
        `subscribers`.`firstname` LIKE :keywords) AND `posts`.`deleted_at` IS NULL;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':keywords', '%' . $keywords . '%');

        $sth->execute();

        $datas = $sth->fetchAll();

        // to deduplicate the post 
        // create an empty associative array that will be used to store elements indexed by their 'id_post'.
        $arrayIndexedByPostIds = array();

        foreach ($datas as $postRow) {
            $id_post = $postRow->id_post;
            $arrayIndexedByPostIds[$id_post] = $postRow;
        }

        return $arrayIndexedByPostIds;
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
            throw new Exception('Erreur lors de la récupération de l\'article');
        }

        $sql2 = 'SELECT `id_category` from `posts_categories` WHERE `id_post` = :id_post';
        $sth2 = $pdo->prepare($sql2);
        $sth2->bindValue(':id_post', $id_post);
        $sth2->execute();
        $dataCategories = $sth2->fetchAll();

        if (!$dataCategories) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la récupération de l\'article');
        }

        $categoryIds = [];
        foreach ($dataCategories as $dataCategory) {
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

        if (!$sth2->execute()) {
            throw new Exception('Erreur lors de la mise à jour de l article');
        }

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

    /**
     * 
     * Méthode permettant la suppression d'un article
     * 
     * @param int $id_post
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public static function delete(int $id_post): bool
    {
        $pdo = Database::connect();

        // Effacer tous les liens article <-> categories
        $sql = 'DELETE FROM `posts_categories` WHERE `id_post` = :id_post;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_post', $id_post, PDO::PARAM_INT);
        $sth->execute();

        if (!$sth->execute()) {
            throw new Exception('Erreur lors de la suppression de l\'article');
        }

        // Effacer dans la table "posts"
        $sql2 = 'DELETE FROM `posts` WHERE `id_post` = :id_post;';

        $sth2 = $pdo->prepare($sql2);

        $sth2->bindValue(':id_post', $id_post);
        $sth2->execute();

        if ($sth2->rowCount() <= 0) {
            throw new Exception("Erreur lors de la suppression de l'article");
        } else {
            return true;
        }
    }

    /**
     * 
     * Méthode permettant d'archiver l'article concerné
     * 
     * @param int $id_post
     * 
     * @return bool
     */
    public static function archive(int $id_post): bool
    {
        $pdo = Database::connect();

        // fonction SQL: NOW() (heure de serveur des données) , décalage avec l'heure réelle (heure de web)
        $sql = 'UPDATE `posts` SET 
                    `deleted_at` = NOW() WHERE `id_post` =:id_post;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':id_post', $id_post, PDO::PARAM_INT);

        $sth->execute();

        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 
     * Méthode permettant de réactiver un article concerné
     * 
     * @param int $id_post
     * 
     * @return bool
     */
    public static function unarchive(int $id_post): bool
    {
        $pdo = Database::connect();

        $sql = 'UPDATE `posts` SET `deleted_at` = NULL WHERE `id_post` = :id_post ;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':id_post', $id_post, PDO::PARAM_INT);

        $sth->execute();

        if (!$sth->execute()) {
            throw new Exception('Erreur lors de la réactivation de l\'artcile.');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }


    /**
     * Méthode permettant de retourner le nombre d'article dans la catégorie concernée
     * 
     * @return int
     */
    public static function count(int $id_category = 0): int
    {
        $pdo = Database::connect();

        if ($id_category == 0) {

            $sql = 'SELECT COUNT(`posts`.`id_post`) FROM `posts`
            JOIN `posts_categories`
            ON `posts`.`id_post` = `posts_categories`.`id_post`
            WHERE `id_category` NOT IN (22) AND `posts`.`deleted_at` IS NULL;';
        } else {
            $sql = 'SELECT COUNT(`posts_categories`.`id_post`) AS nb_posts 
                    FROM `posts_categories`
                    JOIN `categories` 
                    ON `categories`.`id_category` = `posts_categories`.`id_category`
                    JOIN `posts`
                    ON `posts`.`id_post` = `posts_categories`.`id_post`
                    WHERE `categories`.`id_category`= :id_category AND `posts`.`deleted_at` IS NULL;';
        }

        if ($id_category == 0) {
            $sth = $pdo->query($sql);
        } else {
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id_category', $id_category, PDO::PARAM_INT);
        }
        $sth->execute();

        $result = $sth->fetchColumn();

        return $result;
    }

    /**
     * 
     * Méthode permettant de récupérer la liste des articles sous forme de tableau d'objets
     * 
     * @return array Tableau d'objets
     */
    public static function getBySubscriber(int $id_subscriber): array | false
    {
        $pdo = Database::connect();

        $sql = 'SELECT `posts`.*, `subscribers`.`firstname`, `subscribers`.`lastname`
        from `posts` JOIN `subscribers`
        ON `posts`.`id_subscriber` = `subscribers`.`id_subscriber`
        WHERE `posts`.`id_subscriber` = :id_subscriber;';

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_subscriber', $id_subscriber, PDO::PARAM_INT);

        $sth->execute();

        $datas = $sth->fetchAll();

        return $datas;
    }
}

// query for favorite articles
// SELECT favorite_articles.id_post FROM favorite_articles
// JOIN subscribers ON subscribers.id_subscriber = favorite_articles.id_subscriber
// where subscribers.id_subscriber = 26;

// query for preference in terms of categories
// SELECT subscribers_categories.id_category FROM subscribers_categories
// JOIN subscribers ON subscribers.id_subscriber = subscribers_categories.id_subscriber
// WHERE subscribers_categories.id_subscriber = 26;
