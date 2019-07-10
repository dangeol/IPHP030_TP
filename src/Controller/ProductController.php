<?php
// src/Controller/BlogController.php
namespace App\Controller;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class ProductController extends AbstractController

{
	/**
	 * Matches /product exactly
	 * @Route("/product", name="product_list")
	 */
	public function listProductAction()
	{
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/list.html.twig', ['product' => $product]);
	}

    /**
     * Search for an product by its id
     * @Route("/product/{id}", name="product_byId")
     */
    public function showProductAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('product/byId.html.twig', [ 'product' => $product ]);
    }
}