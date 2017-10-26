<?php

namespace Leven\Model;

class Brand
{
    private $id;
    private $name;
    private $introduction_text;
    private $logo_picture;
    private $brand_picture;
    private $model_picture;
    private $article_text;

    /**
     * @return mixed
     */
    public function getArticleText()
    {
        return $this->article_text;
    }

    /**
     * @param mixed $article_text
     * @return Brand
     */
    public function setArticleText($article_text)
    {
        $this->article_text = $article_text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Brand
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Brand
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntroductionText()
    {
        return $this->introduction_text;
    }

    /**
     * @param mixed $introduction_text
     * @return Brand
     */
    public function setIntroductionText($introduction_text)
    {
        $this->introduction_text = $introduction_text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoPicture()
    {
        return $this->logo_picture;
    }

    /**
     * @param mixed $logo_picture
     * @return Brand
     */
    public function setLogoPicture($logo_picture)
    {
        $this->logo_picture = $logo_picture;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBrandPicture()
    {
        return $this->brand_picture;
    }

    /**
     * @param mixed $brand_picture
     * @return Brand
     */
    public function setBrandPicture($brand_picture)
    {
        $this->brand_picture = $brand_picture;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModelPicture()
    {
        return $this->model_picture;
    }

    /**
     * @param mixed $model_picture
     * @return Brand
     */
    public function setModelPicture($model_picture)
    {
        $this->model_picture = $model_picture;
        return $this;
    }
}
