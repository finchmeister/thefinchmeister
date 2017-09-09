<?php


namespace AppBundle\Instagram;

/**
 * Class Instagram
 * @package AppBundle\Service
 */
class Instagram
{

    protected $instagramUser;

    public function __construct(
        string $instagramUser
    ) {
        $this->instagramUser = $instagramUser;
    }

    /**
     * @return array
     */
    private function getResponse()
    {
        $url = sprintf(
            'https://www.instagram.com/%s/media/',
            $this->instagramUser
        );
        return json_decode(file_get_contents($url), 1);
    }

    /**
     * @param int $noOfItems
     * @return InstagramModel[]
     */
    public function getFeed(int $noOfItems = 6)
    {
        $feed = [];
        $response = $this->getResponse();
        for ($i = 0; $i < $noOfItems && $i < count($response['items']); $i++) {
            $item = $response['items'][$i];
            $instagram = new InstagramModel();
            $instagram
                ->setStandardImageUrl($item['images']['standard_resolution']['url'])
                ->setCaptionText($item['caption']['text'])
                ->setLink($item['link']);
            $feed[] = $instagram;
        }
        return $feed;
    }
}