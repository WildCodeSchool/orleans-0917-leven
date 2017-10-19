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

        return $statement->fetchAll(\PDO::FETCH_CLASS, \Leven\Model\IntroductionManager::class);
    }

    public function find(int $id)
    {
        $req = "SELECT *
          FROM introduction
          WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $introductions = $statement->fetchAll(\PDO::FETCH_CLASS, \Leven\Model\IntroductionManager::class);

        $result = "NULL";
        if (!empty($introductions)) {
            $result = $introductions[0];
        }

        return $result;
    }

    public function insert(Introduction $introduction)
    {
        $query = "INSERT INTO introduction (content, video_link) VALUES (:content, :video_link)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('content', $introduction->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('video_link', $introduction->getVideoLink(), \PDO::PARAM_STR);
        $statement->execute();
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
