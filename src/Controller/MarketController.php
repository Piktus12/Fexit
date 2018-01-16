<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Ask;
use App\Entity\AskSum;
use App\Entity\Bid;
use App\Entity\BidSum;
use App\Entity\Market;

class MarketController extends Controller
{
    /**
     * @Route("/market", name="market")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('market/index.html.twig');
    }
    /**
     * @Route("/market/{market}", name="marketview")
     */
    public function marketView(Request $request,$market)
    {
        // replace this line with your own code!
        $res = $this->getDoctrine()
            ->getRepository(Market::class)
            ->findOneBy(['name' => $market]);

        if($res != null)
        {
            $bids = $this->getDoctrine()->getRepository(Bid::class)->findBy(['market' => $res->getId()],['value'=> 'DESC']);
            $asks = $this->getDoctrine()->getRepository(Ask::class)->findBy(['market' => $res->getId()],['value'=> 'ASC']);

            $bidsSum = array();
            $asksSum = array();

            $tempBid = new BidSum();

            foreach($bids as $bid)
            {
                //premier ajout
                if($tempBid->getValue() == 0)
                {
                    $tempBid->setValue($bid->getValue());
                    $tempBid->setVolume($bid->getVolume());
                }
                else if($tempBid->getValue() == $bid->getValue())
                {
                    //ajout du volume
                    $tempBid->setVolume($tempBid->getVolume() + $bid->getVolume());
                }
                else
                {
                    //sinon nouvelle valeur
                    array_push($bidsSum,$tempBid);
                    $tempBid = new BidSum();
                    $tempBid->setValue($bid->getValue());
                    $tempBid->setVolume($bid->getVolume());
                }
            }

            array_push($bidsSum,$tempBid);


            $tempAsk = new AskSum();

            foreach($asks as $ask)
            {
                //premier ajout
                if($tempAsk->getValue() == 0)
                {
                    $tempAsk->setValue($ask->getValue());
                    $tempAsk->setVolume($ask->getVolume());
                }
                else if($tempAsk->getValue() == $ask->getValue())
                {
                    //ajout du volume
                    $tempAsk->setVolume($tempAsk->getVolume() + $ask->getVolume());
                }
                else
                {
                    //sinon nouvelle valeur
                    array_push($asksSum,$tempAsk);
                    $tempAsk = new BidSum();
                    $tempAsk->setValue($ask->getValue());
                    $tempAsk->setVolume($ask->getVolume());
                }
            }

            array_push($asksSum,$tempAsk);



            return $this->render('market/view.html.twig',
                [
                    'bids' => $bidsSum,
                    'asks' => $asksSum
                ]);
        }
        else
        {
            $session = $request->getSession();
            if($session != null)
                $session->getFlashBag()->add('notice',"Market doesn't exist !");
            return $this->redirectToRoute('default');
        }




    }

}
