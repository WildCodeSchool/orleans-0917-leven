<?php

namespace Leven\Model;

class BrandManager extends ModelManager
{
    /**
     * @return array
     */
    public function findAll()
    {
        $query = "SELECT * FROM brand";
        $statement = $this->pdo->query($query);

        return $statement->fetchAll(\PDO::FETCH_CLASS, Brand::class);
    }

    /**
     * @param $brandId
     * @return mixed
     */
    public function find($brandId)
    {
        $query = "SELECT * FROM brand WHERE id=:id";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $brandId, \PDO::PARAM_INT);
        $statement->execute();

        $statement->setFetchMode(\PDO::FETCH_CLASS, Brand::class);

        return $statement->fetch();
    }

    /**
     * @param Brand $brand
     * @return string
     */
    public function insert(Brand $brand) : string
    {
        $query = "INSERT INTO brand
                  (name, introduction_text, logo_picture, brand_picture, model_picture, article_text)
                  VALUES (:name, :introduction_text, :logo_picture, :brand_picture, :model_picture, :article_text)";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':name', $brand->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':introduction_text', $brand->getIntroductionText(), \PDO::PARAM_STR);
        $statement->bindValue(':logo_picture', $brand->getLogoPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':brand_picture', $brand->getBrandPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':model_picture', $brand->getModelPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':article_text', $brand->getArticleText(), \PDO::PARAM_STR);

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    /**
     * @param Brand $brand
     */
    public function update(Brand $brand)
    {
        $query = "UPDATE brand
                  SET name=:name,
                   introduction_text=:introduction_text,
                   logo_picture=:logo_picture,
                   brand_picture=:brand_picture,
                   model_picture=:model_picture,
                   article_text=:article_text
                  WHERE id=:id";

        $statement = $this->pdo->prepare($query);

        $statement->bindValue(':id', $brand->getId(), \PDO::PARAM_STR);
        $statement->bindValue(':name', $brand->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':introduction_text', $brand->getIntroductionText(), \PDO::PARAM_STR);
        $statement->bindValue(':logo_picture', $brand->getLogoPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':brand_picture', $brand->getBrandPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':model_picture', $brand->getModelPicture(), \PDO::PARAM_STR);
        $statement->bindValue(':article_text', $brand->getArticleText(), \PDO::PARAM_STR);

        $statement->execute();
    }
}
