<?php

require_once 'utilities/Database.php';

abstract class Model
{
    protected PDO $pdo;

    protected string $table_name;

    public function __construct()
    {
        $this->pdo = Database::getPdo();
    }

    /**
     * @param int $id l'identifiant de l'élément à afficher
     * @param string|null $class_name le nom de la classe si jamais on aura besoin de récupérer l'élément sous format d'objet
     * @return array|object|false
     */
    public function find(int $id, string $class_name = null) : array|object|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table_name} WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        if ($class_name)
            $stmt->setFetchMode(PDO::FETCH_CLASS , $class_name);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * get all elements
     * @param string|null $class_name
     * @return array|false
     */
    public function findAll(string $class_name = null) : array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table_name}");
        if ($class_name)
            $stmt->setFetchMode(PDO::FETCH_CLASS , $class_name);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * delete an item
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table_name} WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

    /**
     * permet de récupérer plusieurs éléments selon un ou plusieurs critères de recherche
     * @param array $criteria les critères de recherche
     * @param string|null $class_name
     * @return array|false
     */
    public function findAllBy(array $criteria , string $class_name=null) : array|false
    {
        if (empty($criteria)){
            throw  new Exception("Il faut passer au moins un critère");
        }

        $sql_query = "SELECT * FROM {$this->table_name} WHERE ";
        $count = 0;
        foreach ($criteria as $key => $value){
            $count ++;
            if ($count > 1 ){
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $stmt = $this->pdo->prepare($sql_query);

        if ($class_name)
            $stmt->setFetchMode(PDO::FETCH_CLASS , $class_name);

        $stmt->execute($criteria);
        return $stmt->fetchAll();
    }

    /**
     * Récupérer un élément avec un ou plusieurs critères
     * @param array $criteria
     * @param string|null $class_name
     * @return object|array|false
     * @throws Exception
     */
    public function findOneBy(array $criteria , string $class_name=null) : object|array|false
    {
        if (empty($criteria)){
            throw  new Exception("Il faut passer au moins un critère");
        }
        $sql_query = "SELECT * FROM {$this->table_name} WHERE ";
        $count = 0;
        foreach ($criteria as $key => $value){
            $count ++;
            if ($count > 1 ){
                $sql_query .= " AND ";
            }
            $sql_query .= " $key = :$key ";
        }

        $stmt = $this->pdo->prepare($sql_query);
        foreach ($criteria as $key => $value){
            $stmt->bindParam(":$key", $value);
        }
        if ($class_name){
            $stmt->setFetchMode(PDO::FETCH_CLASS , $class_name);
        }
        $stmt->execute();
        return $stmt->fetch();
    }
}
