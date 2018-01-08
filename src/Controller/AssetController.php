<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Asset;

class AssetController extends Controller
{
    /**
     * @Route("/asset", name="asset")
     */
    public function index()
    {
         $em = $this->getDoctrine()->getManager();

        $asset = new Asset();
        $asset->setName('Bitcoin');
        $asset->setMnemonic('BTC');
       

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($asset);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$asset->getId());

    }
	/**
	 * @Route("/asset/new/", name="asset_new")
	 */
	
	public function new(Request $request)
    {
        // create a task and give it some dummy data for this example
        $asset = new Asset();
        $asset->setName('Add new Asset');
        $asset->setMnemonic('ASSET');

        $form = $this->createFormBuilder($asset)
            ->add('name', TextType::class)
            ->add('mnemonic', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Asset'))
            ->getForm();
		
		
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// $form->getData() holds the submitted values
			// but, the original `$task` variable has also been updated
			$asset = $form->getData();

			// ... perform some action, such as saving the task to the database
			// for example, if Task is a Doctrine entity, save it!
			$em = $this->getDoctrine()->getManager();
			$em->persist($asset);
			$em->flush();

			return $this->redirectToRoute('asset_success',array('id' => $asset->getId()));
		}
	
        return $this->render('asset/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
		
		
	/**
	 * @Route("/asset/success", name="asset_success")
	 */
	
	public function success($id)
    {
			
		return new Response('Saved new product with id '.$id);
	}

	

	
	/**
	 * @Route("/asset/{id}", name="asset_show")
	 */
	public function showAction($id)
	{
		$asset = $this->getDoctrine()
			->getRepository(Asset::class)
			->find($id);
			
		
		if (!$asset) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}

		return new Response('Check out this great product: '.$asset->getName());

		// or render a template
		// in the template, print things with {{ product.name }}
		// return $this->render('product/show.html.twig', ['product' => $product]);
	}
	
}	
