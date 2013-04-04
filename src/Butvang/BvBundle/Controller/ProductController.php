<?php

namespace Butvang\BvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Butvang\BvBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

//http://symfony.com/doc/current/book/doctrine.html
//http://symfony.com/doc/2.0/book/doctrine.html
//http://no-fucking-idea.com/blog/2012/04/01/using-map-reduce-with-mongodb/
//http://www.javacodegeeks.com/2012/06/mapreduce-with-mongodb.html
class ProductController extends Controller
{
    public function createAction(){
    	$product = new Product();
	    $product->setName('A Foo Bar');
	    $product->setPrice('19.99');
	    $product->setDescription('Lorem ipsum dolor');

	    $em = $this->getDoctrine()->getEntityManager();
	    $em->persist($product);
	    $em->flush();

	    return new Response('Created product id '.$product->getId());
    }

    public function showAllAction(){
	    $products = $this->getDoctrine()
	        ->getRepository('ButvangBvBundle:Product')
	        ->findAll();

	    if (!$products) {
	        throw $this->createNotFoundException(
	            'No product found'
	        );
	    }
	    return $this->render('ButvangBvBundle:Product:index.html.twig', array('products' => $products));
	}

	public function showAction( $id ){
    	$product = array();
	    $products = $this->getDoctrine()
	        ->getRepository('ButvangBvBundle:Product')
	        ->find( $id );
        $product[] = $products;
	    if (!$products) {
	        throw $this->createNotFoundException('No product found for id '.$id);
	    }
	    return $this->render('ButvangBvBundle:Product:index.html.twig', array('products' => $product));
	}

    public function updateAction( $id ){
    	$em = $this->getDoctrine()->getEntityManager();
	    $product = $em->getRepository('ButvangBvBundle:Product')->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    $product->setName('New product name!');
	    $em->flush();

	    return $this->redirect($this->generateUrl('butvang_bv_product_show_all'));
    }

    public function deleteAction( $id ){
    	$em = $this->getDoctrine()->getEntityManager();
	    $product = $em->getRepository('ButvangBvBundle:Product')->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    $em->remove($product);
		$em->flush();

	    return $this->redirect($this->generateUrl('butvang_bv_product_show_all'));
    }
}
