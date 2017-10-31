<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/10/17
 * Time: 16:20
 */

namespace Leven\Model;

class Company
{
    private $id;
    private $content;
    private $videoLink;
    private $picture1;
    private $picture2;
    private $picture3;

    /**
     * @return mixed
     */
    public function getPicture1()
    {
        return $this->picture1;
    }

    /**
     * @param mixed $picture1
     * @return Company
     */
    public function setPicture1($picture1)
    {
        $this->picture1 = $picture1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture2()
    {
        return $this->picture2;
    }

    /**
     * @param mixed $picture2
     * @return Company
     */
    public function setPicture2($picture2)
    {
        $this->picture2 = $picture2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture3()
    {
        return $this->picture3;
    }

    /**
     * @param mixed $picture3
     * @return Company
     */
    public function setPicture3($picture3)
    {
        $this->picture3 = $picture3;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Company
     */
    public function setId(int $id) : Company
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Company
     */
    public function setContent(string $content) : Company
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideoLink()
    {
        return $this->videoLink;
    }

    /**
     * @param mixed $videoLink
     * @return Company
     */
    public function setVideoLink(string $videoLink) : Company
    {
        $this->videoLink = $videoLink;
        return $this;
    }
}
