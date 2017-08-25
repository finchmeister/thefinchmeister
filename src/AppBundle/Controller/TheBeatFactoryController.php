<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TheBeatFactoryController extends Controller
{
    /**
     * @Route("/thebeatfactory", name="the_beat_factory")
     */
    public function indexAction(Request $request)
    {

        return new Response('the beat factory');
    }
}
