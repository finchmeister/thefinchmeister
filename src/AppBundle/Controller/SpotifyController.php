<?php

namespace AppBundle\Controller;

use AppBundle\Spotify\Spotify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SpotifyController
 * @package AppBundle\Controller
 * @Route("/spotify")
 */
class SpotifyController extends Controller
{
    /**
     * @Route("/", name="spotify")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // Get recently played tracks

        return new Response('spotify');
    }

    /**
     * @Route("/callback", name="spotify_callback")
     * @param Request $request
     * @return Response
     */
    public function callbackAction(Spotify $spotify, Request $request)
    {

        $code = $request->get('code');

        $spotify->getSession()->requestAccessToken($code);
        $accessToken = $spotify->getSession()->getAccessToken();

        // Set the access token on the API wrapper
        $spotify->getApi()->setAccessToken($accessToken);

        $refreshToken = $spotify->getSession()->getRefreshToken();
        file_put_contents(__DIR__.'/refreshtoke', $refreshToken);

        $incubus = $spotify->getApi()->getArtist('3YcBF2ttyueytpXtEzn1Za');
        $incubus = $spotify->getApi()->getMyRecentTracks();
        return new Response(json_encode($incubus, JSON_PRETTY_PRINT));
    }

    /**
     * @Route("/authorise", name="spotify_authorise")
     * @param Request $request
     * @return Response
     */
    public function authoriseAction(Spotify $spotify, Request $request)
    {
        return new RedirectResponse($spotify->getAuthoriseUrl());

        //
    }

    /**
     * @Route("/test", name="spotify_test")
     * @param Request $request
     * @return Response
     */
    public function testingAction(Spotify $spotify, Request $request)
    {
        $refreshToken = $this->getParameter('spotify_refresh_token');
        $spotify->getSession()->refreshAccessToken($refreshToken);

        $accessToken = $spotify->getSession()->getAccessToken();

        $api = $spotify->getApi();
        $api->setAccessToken($accessToken);

        return new Response(json_encode($api->getMyRecentTracks(), JSON_PRETTY_PRINT));
    }

    /**
     * @Route("/recently-played", name="spotify_recently_played")
     * @param Spotify $spotify
     * @param Request $request
     * @return Response
     */
    public function getRecentlyPlayed(Spotify $spotify, Request $request)
    {
        $recentTracks = $spotify->getMyTop('artists', [
            'time_range' => 'short_term'
        ]);

        return $this->render(
            'spotify/recently_played.html.twig',
            ['recentTracks' => $recentTracks->items,]
        );
    }
}
