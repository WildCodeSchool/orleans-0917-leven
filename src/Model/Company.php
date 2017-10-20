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
    private $video_link;

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
        return $this->video_link;
    }

    /**
     * @param mixed $video_link
     * @return Company
     */
    public function setVideoLink(string $video_link) : Company
    {
        $this->video_link = $video_link;
        return $this;
    }
}
