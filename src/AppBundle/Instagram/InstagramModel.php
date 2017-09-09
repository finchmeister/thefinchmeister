<?php


namespace AppBundle\Instagram;

/**
 * Class InstagramModel
 * @package AppBundle\Instagram
 */
class InstagramModel
{

    /**
     * @var string
     */
    protected $standardImageUrl;

    /**
     * @var string
     */
    protected $captionText;

    /**
     * @var string
     */
    protected $link;

    /**
     * @return string
     */
    public function getStandardImageUrl(): string
    {
        return $this->standardImageUrl;
    }

    /**
     * @param string $standardImageUrl
     * @return InstagramModel
     */
    public function setStandardImageUrl(string $standardImageUrl): InstagramModel
    {
        $this->standardImageUrl = $standardImageUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCaptionText(): string
    {
        return $this->captionText;
    }

    /**
     * @param string $captionText
     * @return InstagramModel
     */
    public function setCaptionText(string $captionText): InstagramModel
    {
        $this->captionText = $captionText;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return InstagramModel
     */
    public function setLink(string $link): InstagramModel
    {
        $this->link = $link;
        return $this;
    }

}
