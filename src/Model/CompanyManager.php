<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/10/17
 * Time: 16:11
 */

namespace Leven\Model;

class CompanyManager extends ModelManager
{
    public function findAll()
    {
        $req = "SELECT * FROM company";
        $statement = $this->pdo->query($req);

        return $statement->fetchAll(\PDO::FETCH_CLASS, Company::class);
    }

    public function find(int $id)
    {
        $req = "SELECT *
          FROM company
          WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $statement->setFetchMode(\PDO::FETCH_CLASS, Company::class);

        return $statement->fetch();
    }

    public function insert(Company $company)
    {
        $query = "INSERT INTO company (content, video_link, picture1, picture2, picture3) 
                  VALUES (:content, :video_link, :picture1, :picture2, :picture3)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':content', $company->getContent(), \PDO::PARAM_STR);
        $statement->bindValue(':video_link', $company->getVideoLink(), \PDO::PARAM_STR);
        $statement->bindValue(':picture1', $company->getPicture1(), \PDO::PARAM_STR);
        $statement->bindValue(':picture2', $company->getPicture2(), \PDO::PARAM_STR);
        $statement->bindValue(':picture3', $company->getPicture3(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function update(Company $company)
    {
        $query = "UPDATE company SET content=:content, video_link=:video_link, picture1=:picture1, picture2=:picture2, picture3=:picture3";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':content', $company->getContent(), \PDO::PARAM_STR);
        $statement->bindValue(':video_link', $company->getVideoLink(), \PDO::PARAM_STR);
        $statement->bindValue(':picture1', $company->getPicture1(), \PDO::PARAM_STR);
        $statement->bindValue(':picture2', $company->getPicture2(), \PDO::PARAM_STR);
        $statement->bindValue(':picture3', $company->getPicture3(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
