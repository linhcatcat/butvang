<?php

namespace Butvang\BvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Butvang\BvBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	var_dump(123456);
        return $this->render('ButvangBvBundle:Default:index.html.twig', array('name' => $name));
    }
}
