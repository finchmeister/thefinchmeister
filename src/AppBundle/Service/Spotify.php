<?php


namespace AppBundle\Service;

use SpotifyWebAPI;

class Spotify
{

    const USER_SCOPE = [
        'playlist-read-private',
        'playlist-read-collaborative',
        'playlist-modify-public',
        'playlist-modify-private',
        'streaming',
        'ugc-image-upload',
        'user-follow-modify',
        'user-follow-read',
        'user-library-read',
        'user-library-modify',
        'user-read-private',
        'user-read-birthdate',
        'user-read-email',
        'user-top-read',
        'user-read-playback-state',
        'user-modify-playback-state',
        'user-read-currently-playing',
        'user-read-recently-played',
    ];

    /**
     * @var SpotifyWebAPI\Session
     */
    protected $session;

    /**
     * @var SpotifyWebAPI\SpotifyWebAPI
     */
    protected $api;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $redirectURI
    ) {
        $this->session = new SpotifyWebAPI\Session(
            $clientId,
            $clientSecret,
            $redirectURI
        );

        $this->api = new SpotifyWebAPI\SpotifyWebAPI();
    }

    public function getOptions()
    {
        return [
            'scope' => self::USER_SCOPE,
        ];
    }

    public function getAuthoriseUrl()
    {
        return $this->session->getAuthorizeUrl($this->getOptions());
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getApi()
    {
        return $this->api;
    }


}