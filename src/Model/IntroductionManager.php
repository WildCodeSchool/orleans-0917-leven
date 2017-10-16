<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/10/17
 * Time: 16:11
 */

namespace Leven\Model;


class IntroductionManager extends ModelManager
{
    public function findAll()
    {
        $req = "SELECT * FROM introduction";
        $statement = $this->pdo->query($req);

        return $statement->fetchAll(\PDO::FETCH_CLASS, \WildTrombi\Model\Person::class);
    }

    public function find(int $id)
    {
        $req = "SELECT * FROM introduction WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $persons = $statement->fetchAll(\PDO::FETCH_CLASS, \Leven\Model\IntroductionManager::class);
        return $persons[0];
    }

    public function insert()
    {
        // TODO
    }

    public function update()
    {
        // TODO
    }

    public function delete()
    {
        // TODO
    }

}