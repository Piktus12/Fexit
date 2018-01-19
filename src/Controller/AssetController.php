<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Asset;
use App\Entity\AssetsJS;
use App\Entity\Market;

class AssetController extends Controller
{
    /**
     * @Route("/asset", name="asset")
     */
    public function index()
    {

        $assets = $this->getDoctrine()
            ->getRepository(Asset::class)
            ->findAllWithoutBTC();

        $market =  $this->getDoctrine()
            ->getRepository(Market::class)
            ->findAll();

        return $this->render('asset/index.html.twig');
    }


    /**
     * @Route("/assetJS", name="assetJS")
     */
    public function indexJs()
    {

        $assets = $this->getDoctrine()
            ->getRepository(Asset::class)
            ->findAllWithoutBTC();

        $markets =  $this->getDoctrine()
            ->getRepository(Market::class)
            ->findAll();


        $assetsJS = Array();

        foreach($assets as $asset)
        {
            $assetJS = Array();
            array_push($assetJS,$asset->getName() . " (" . $asset->GetMnemonic() .")");
            foreach($markets as $market)
            {
                if($market->getIdAsset() == $asset->getId())
                {
                    array_push($assetJS,"<a href=\""
                        . $this->generateUrl('marketview',array('market'=>$market->getName()))
                        . "\">"
                        . $market->GetName()
                        . "</a></td>"
                    );
                    array_push($assetJS,$market->getLastPrice());
                    array_push($assetJS,$market->getVolume());
                    array_push($assetJS,number_format($market->getLastBid(),8));

                    array_push($assetJS,number_format($market->getLastAsk(),8));
                    array_push($assetJS,$market->getPercentChange());
                }
            }
            array_push($assetsJS,$assetJS);
        }

        return $this->json($assetsJS);
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
	 * @Route("/asset/{name}", name="asset_show")
	 */
	public function showAction($name)
	{
		$asset = $this->getDoctrine()
			->getRepository(Asset::class)
			->findOneBy(['name' => $name]);
			
		
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
