<?php


namespace AppBundle\Spotify;

use SpotifyWebAPI;

/**
 * Class Spotify
 * @package AppBundle\Service
 */
class Spotify
{

    /**
     * Grant all permissions
     */
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
        string $redirectURI,
        string $refreshToken = ''
    ) {
        $this->session = new SpotifyWebAPI\Session(
            $clientId,
            $clientSecret,
            $redirectURI
        );

        $this->api = new SpotifyWebAPI\SpotifyWebAPI();

        if ($refreshToken !== '') {
            $this->session->refreshAccessToken($refreshToken);
            $accessToken = $this->session->getAccessToken();
            $this->api->setAccessToken($accessToken);
        }
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'scope' => self::USER_SCOPE,
        ];
    }

    /**
     * @return string
     */
    public function getAuthoriseUrl()
    {
        return $this->session->getAuthorizeUrl($this->getOptions());
    }

    /**
     * @return SpotifyWebAPI\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return SpotifyWebAPI\SpotifyWebAPI
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @link https://developer.spotify.com/web-api/web-api-personalization-endpoints/get-recently-played/
     * @param int $limit
     * @param int|null $after
     * @param int|null $before
     * @return array|object
     */
    public function getMyRecentTracks(int $limit = 10, int $after = null, int $before = null)
    {
        $params['limit'] = $limit;
        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($before !== null) {
            $params['before'] = $before;
        }

        return $this->api->getMyRecentTracks(
            $params
        );
    }

    // https://developer.spotify.com/web-api/get-users-top-artists-and-tracks/
    public function getMyTop(string $type, array $options = [])
    {
        return $this->api->getMyTop($type, $options);
    }
}
