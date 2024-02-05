<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Post {
    private ?int $id_post;
    private string $title;
    private string $content;
    private ?DateTime $published_at;
    private ?DateTime $archived_at;
    private ?DateTime $updated_at;
    private ?DateTime $deleted_at;
    private string $image;
    private ?int $id_subscriber;


    //*************** ID POST ***************//
    public function getId_post():?int
    {
        return $this->id_post;
    }

    public function setId_post(?int $id_post)
    {
        $this->id_post = $id_post;
    }

    //*************** TITLE ***************//
    public function getTitle():string
    {
        return $this->title;
    }
 
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    //*************** CONTENT ***************//
    public function getContent():string
    {
        return $this->content;
    }
 
    public function setContent(string $content)
    {
        $this->content = $content;
    }

   //*************** PUBLISH AT ***************//
    public function getPublished_at():?DateTime
    {
        return $this->published_at;
    }

    public function setPublished_at(?string $published_at)
    {
        $this->published_at = new DateTime($published_at);
    }

   //*************** ARCHIVED AT ***************// 
    public function getArchived_at():?DateTime
    {
        return $this->archived_at;
    }

    public function setArchived_at(?string $archived_at)
    {
        $this->archived_at = new DateTime($archived_at);
    }

    //*************** UPDATED AT ***************// 
    public function getUpdated_at():?DateTime
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?string $updated_at)
    {
        $this->updated_at = new DateTime($updated_at);
    }

    //*************** DELETED AT ***************// 
    public function getDeleted_at():?DateTime
    {
        return $this->deleted_at;
    }

    public function setDeleted_at(?string $deleted_at)
    {
        $this->deleted_at = new DateTime($deleted_at);
    }

    //*************** IMAGE ***************// 
    public function getImage():string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    //*************** ID SUBSCRIBER ***************// 

    public function getId_subscriber():?int
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
                    (`title`, `content`, `image`, `id_subscriber`) 
                VALUES
                    (:title, :content, :image, :id_subscriber);';
    
        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':lastname', $this->getTitle());
        $sth->bindValue(':firstname', $this->getContent());
        $sth->bindValue(':email', $this->getImage());
        $sth->bindValue(':password', $this->getId_subscriber());

        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception("Erreur lors de l'enregistrement de de l'article.");
        } else {
         // Retourne true dans le cas contraire (tout s'est bien passé)
         return true;
        }
    }


    

}