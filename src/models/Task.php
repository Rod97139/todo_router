<?php

require_once 'utilities/Model.php';

class Task  extends Model
{
    private int $id;
    private string $name;
    private DateTimeImmutable $to_do_at;
    private bool $is_done = false;
    private int $id_user;
    protected string $table_name = "task";



    // accesseurs (getters & setters)

    /**
     * Permet de récupérer l'identifiant de la tâche
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getToDoAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->to_do_at);
    }

    /**
     * @param DateTimeImmutable $to_do_at
     * @return void
     */
    public function setToDoAt(DateTimeImmutable $to_do_at): void
    {

        $this->to_do_at = $to_do_at;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->is_done;
    }

    /**
     * @param bool $is_done
     * @return void
     */
    public function setIsDone(bool $is_done): void
    {
        $this->is_done = $is_done;
    }


    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return void
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * Insérer une tache dans la BDD
     * @return int|false l'id du dernier élément inséré ou false dans le cas d'échec
     */
    public function insert() : int|false
    {
        $stmt = $this->pdo->prepare("INSERT INTO task (`name`, `to_do_at`, `is_done`,`id_user`) VALUES (:name, :to_do_at, :is_done, :id_user)");

        $stmt->execute([
            'name' => $this->name,
            'to_do_at' => $this->to_do_at->format('Y-m-d H:i'),
            'is_done' => $this->is_done,
            'id_user' => $this->id_user,
        ]);

        return $this->pdo->lastInsertId();
    }

}

