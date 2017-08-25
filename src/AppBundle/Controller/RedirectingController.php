<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @link https://symfony.com/doc/current/routing/redirect_trailing_slash.html
 * Consider doing this on the webserver
 * Class RedirectingController
 * @package AppBundle\Controller
 */
class RedirectingController extends Controller
{

    /**
     * @Route("/{url}", name="remove_trailing_slash",
     *     requirements={"url" = ".*\/$"}, methods={"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        return $this->redirect($url, 301);
    }
}