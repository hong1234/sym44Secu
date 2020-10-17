<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/insert", name="product_insert")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Toy');
        $product->setPrice(19);
        $product->setDescription('For woman');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/product", name="all_product")
     */
    public function productAll()
    {
        $minPrice = 20;

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllLessThanPrice($minPrice);

        //return new Response('Check out this great product: '.$products[0]->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('product/show.html.twig', [
            'product' => $products[0]
        ]);
    }

}
