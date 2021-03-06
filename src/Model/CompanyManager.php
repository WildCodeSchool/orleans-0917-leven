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

    public function findFirst()
    {
        $req = "SELECT *
          FROM company
          LIMIT 0,1";
        $statement = $this->pdo->query($req);
        $result = $statement->fetchAll(\PDO::FETCH_CLASS, Company::class);
        if ($result) {
            $result = $result[0];
        }
        return $result;
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
