<?php

require_once 'utilities/Model.php';

class User extends Model
{
    private  int $id;
    private string $email;
    private string $password;

    protected string $table_name = "user";


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    /**
     * Insérer un utilisateur dans la BDD
     * @return int|false  l'id du dernier élément inséré ou false dans le cas d'échec
     */
    public function insert() : int|false
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (`email`, `password`) VALUES (:email, :password)");

        $stmt->execute([
            "email" => $this->email,
            "password" => password_hash($this->password, PASSWORD_ARGON2ID)
        ]);
        return $this->pdo->lastInsertId();
    }



}