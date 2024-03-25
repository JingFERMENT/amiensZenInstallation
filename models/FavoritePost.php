<?php
require_once(__DIR__ . '/../helpers/connect.php');

class FavoritePost
{
    private ?int $id_post;
    private ?int $id_subscriber;

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
     * Méthode permettant l'enregistrement d'un article favori
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */

    public function insertFavoritePost(): bool
    {
        $pdo = Database::connect();

        $sql = 'INSERT INTO `favorite_articles` 
                     (`id_post`, `id_subscriber`) 
                 VALUES
                     (:id_post, :id_subscriber);';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':id_post', $this->getId_post(), PDO::PARAM_INT);
        $sth->bindValue(':id_subscriber', $this->getId_subscriber(), PDO::PARAM_INT);

        $sth->execute();


        if ($sth->rowCount() <= 0) {
            throw new Exception("Erreur lors de l'\enregistrement de l'article favori.");
        } else {
            return true;
        }
    }
}

    // SELECT favorite_articles.id_post FROM favorite_articles
    // JOIN subscribers ON subscribers.id_subscriber = favorite_articles.id_subscriber
    // where subscribers.id_subscriber = 26;
