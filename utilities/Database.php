<?php

/**
 * Définir la classe Singleton: cette classe ne peut être instanciée qu'une seule fois
 */
class Database
{
    private static PDO|null $instance = null;

    /**
     * @return PDO
     */
    public static function getPdo(): PDO
    {

        if (self::$instance == null){
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=todo",
                    "root",
                    "",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            }catch (PDOException $exception){
                echo $exception->getMessage();
                die;
            }
        }

        return  self::$instance;
    }

}