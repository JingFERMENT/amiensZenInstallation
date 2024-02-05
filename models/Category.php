<?php
require_once(__DIR__ . '/../helpers/connect.php');

class Category
{
    private ?int $id_category;
    private string $name;

    public function __construct(?int $id_category = NULL, string $name = '')
    {
        $this->setId_Category($id_category);
        $this->setName($name);
    }

    //*************** ID CATEGORY ***************//
    public function getId_category(): int
    {
        return $this->id_category;
    }

    public function setId_category(?int $id_category)
    {
        $this->id_category = $id_category;
    }

    //*************** NAME ***************//
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function insert(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant un marqueur nominatif
        $sql = 'INSERT INTO `categories` (`name`) VALUES (:name);';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':name', $this->getName());

        // Exécution de la requête
        $sth->execute();

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        // par la dernière requête (fonctionnel uniquement sur insert, update, ou delete. PAS SUR SELECT!!)
        if ($sth->rowCount() <= 0) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de l\'enregistrement de la catégorie');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    public static function isExist($name): bool
    {
        $pdo = Database::connect();
        $sql = 'SELECT COUNT(*) FROM `categories` WHERE `name` = :name';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':name', $name);
        $sth->execute();

        // Récupérer le résultat de la requête (nombre de lignes correspondantes)
        $rowCount = $sth->fetchColumn();

        // Si le nombre de lignes correspondantes est supérieur à zéro, la valeur existe
        return $rowCount > 0;
    }

    /**
     * Méthode permettant de récupérer la liste des catégories sous forme de tableau d'objets
     * @return array Tableau d'objets
     */
    public static function getAll(): array
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `categories` ORDER by `name`';
        $sth = $pdo->query($sql);
        $datas = $sth->fetchAll();
        return $datas;
    }


    /**
     * Méthode permettant  de récupérer un objet standard avec pour propriétés, les colonnes sélectionnées
     * 
     * @param int $id_category id de l'enregistrement à récupérer
     * 
     * @return object
     */
    public static function get(int $id_category): object|false
    {
        $pdo = Database::connect();
        $sql = 'SELECT * from `categories` WHERE `id_category` = :id_category';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':id_category', $id_category);

        // Exécution de la requête
        $sth->execute();
        $data = $sth->fetch();
        // On teste si data est vide.
        if (!$data) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la récupération de la catégorie');
        } else {
            // Retourne la data dans le cas contraire (tout s'est bien passé)
            return $data;
        }
    }

    /**
     * Méthode permettant l'enregistrement la mise à jour d'une catégorie
     * 
     * @return bool True en cas de succès, sinon une erreur de type Exception est générée
     */
    public function update(): bool
    {
        // Création d'une variable recevant un objet issu de la classe PDO 
        $pdo = Database::connect();

        // Requête contenant un marqueur nominatif
        $sql = 'UPDATE `categories` SET `name` = :name WHERE `id_category` = :id_category;';

        // Si marqueur nominatif, il faut préparer la requête
        $sth = $pdo->prepare($sql);

        // Affectation de la valeur correspondant au marqueur nominatif concerné
        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':id_category', $this->getId_category());

        // Appel à la méthode rowCount permettant de savoir combien d'enregistrements ont été affectés
        if (!$sth->execute()) {
            // Génération d'une exception renvoyant le message en paramètre au catch créé en amont et arrêt du traitement.
            throw new Exception('Erreur lors de la mise à jour de la catégorie');
        } else {
            // Retourne true dans le cas contraire (tout s'est bien passé)
            return true;
        }
    }

    
}
