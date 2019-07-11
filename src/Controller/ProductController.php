<?php
namespace App\Controller;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductFilterType;
use Symfony\Component\Routing\Annotation\Route;
class ProductController extends AbstractController

{
    /**
     * @param Request $request
     * @Route("/product", name="product_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function listProductAction(Request $request)
	{
        $form = $this->get('form.factory')->create(ProductFilterType::class);

        if ($request->query->has($form->getName())) {
            // manually bind values from the request
            $form->submit($request->query->get($form->getName()));

            // initialize a query builder
            $filterBuilder = $this->getDoctrine()->getManager()
                ->getRepository(Product::class)
                ->createQueryBuilder('e');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            // now look at the DQL =)
            var_dump($filterBuilder->getDql());
        }

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/list.html.twig', array(
            'form' => $form->createView(),
            'product' => $product
        ));
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