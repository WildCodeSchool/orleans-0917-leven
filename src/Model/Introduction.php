<?php
/**
 * Created by PhpStorm.
 * User: wilder14
 * Date: 16/10/17
 * Time: 16:20
 */

namespace Leven\Model;

class Introduction
{
    private $id;
    private $content;
    private $video_link;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Introduction
     */
    public function setId($id)
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
     * @return Introduction
     */
    public function setContent($content)
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
     * @return Introduction
     */
    public function setVideoLink($video_link)
    {
        $this->video_link = $video_link;
        return $this;
    }
}
