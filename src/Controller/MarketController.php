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
use App\Entity\Asset;

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

            $sum = 0.0;

            foreach($bids as $bid)
            {
                //premier ajout
                if($tempBid->getValue() == 0)
                {
                    $tempBid->setValue($bid->getValue());
                    $tempBid->setSize($bid->getVolume());
                }
                else if($tempBid->getValue() == $bid->getValue())
                {
                    //ajout du volume
                    $tempBid->setSize($tempBid->getSize() + $bid->getVolume());
                }
                else
                {
                    //sinon nouvelle valeur
                    $tempBid->setBtcVal((float)$tempBid->getSize() * (float)$tempBid->getValue());
                    //echo (float)$tempBid->getSize() * (float)$tempBid->getValue();
                    $sum += (float)$tempBid->getBtcVal();
                    $tempBid->setSum($sum);
                    array_push($bidsSum,$tempBid);
                    $tempBid = new BidSum();
                    $tempBid->setValue($bid->getValue());
                    $tempBid->setSize($bid->getVolume());
                }
            }

            $tempBid->setBtcVal($tempBid->getSize() * $tempBid->getValue());
            $sum += $tempBid->getBtcVal();
            $tempBid->setSum($sum);

            array_push($bidsSum,$tempBid);


            $tempAsk = new AskSum();


            $sum = 0;

            foreach($asks as $ask)
            {
                //premier ajout
                if($tempAsk->getValue() == 0)
                {
                    $tempAsk->setValue($ask->getValue());
                    $tempAsk->setSize($ask->getVolume());
                }
                else if($tempAsk->getValue() == $ask->getValue())
                {
                    //ajout du volume
                    $tempAsk->setSize($tempAsk->getSize() + $ask->getVolume());
                }
                else
                {

                    //sinon nouvelle valeur
                    $tempAsk->setBtcVal($tempAsk->getSize() * $tempAsk->getValue());
                    $sum += $tempAsk->getBtcVal();
                    $tempAsk->setSum($sum);

                    array_push($asksSum,$tempAsk);
                    $tempAsk = new BidSum();
                    $tempAsk->setValue($ask->getValue());
                    $tempAsk->setSize($ask->getVolume());
                }
            }

            $tempAsk->setBtcVal($tempAsk->getSize() * $tempAsk->getValue());
            $sum += $tempAsk->getBtcVal();
            $tempAsk->setSum($sum);

            array_push($asksSum,$tempAsk);


            $coin = $this->getDoctrine()->getRepository(Asset::class)->findOneBy(['id' => $res->getIdAsset()]);

            return $this->render('market/view.html.twig',
                [
                    'bids' => $bidsSum,
                    'asks' => $asksSum,
                    'coin' => $coin,
                    'market' => $res
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

    /**
     * @Route("/marketJS/{method}/{market}", name="marketJS")
     */
    public function marketJS(Request $request,$market,$method)
    {
        $res = $this->getDoctrine()
            ->getRepository(Market::class)
            ->findOneBy(['name' => $market]);

        if($res != null)
        {
            if($method == "ASK")
            {
                $asks = $this->getDoctrine()->getRepository(Ask::class)->findBy(['market' => $res->getId()],['value'=> 'ASC']);
                $asksSum = array();

                $sum = 0.0;

                $tempAsk = new AskSum();


                foreach($asks as $ask)
                {
                    //premier ajout
                    if($tempAsk->getValue() == 0)
                    {
                        $tempAsk->setValue($ask->getValue());
                        $tempAsk->setSize($ask->getVolume());
                    }
                    else if($tempAsk->getValue() == $ask->getValue())
                    {
                        //ajout du volume
                        $tempAsk->setSize($tempAsk->getSize() + $ask->getVolume());
                    }
                    else
                    {

                        //sinon nouvelle valeur
                        $tempAsk->setBtcVal($tempAsk->getSize() * $tempAsk->getValue());
                        $sum += $tempAsk->getBtcVal();
                        $tempAsk->setSum($sum);


                        array_push($asksSum,array(
                            number_format($tempAsk->getValue(),8),
                            number_format($tempAsk->getSize(),4),
                            number_format($tempAsk->getBtcVal(),8),
                            number_format($tempAsk->getSum(),8)
                        ));
                        $tempAsk = new AskSum();
                        $tempAsk->setValue($ask->getValue());
                        $tempAsk->setSize($ask->getVolume());
                    }
                }

                $tempAsk->setBtcVal($tempAsk->getSize() * $tempAsk->getValue());
                $sum += $tempAsk->getBtcVal();
                $tempAsk->setSum($sum);

                array_push($asksSum,array(
                    number_format($tempAsk->getValue(),8),
                    number_format($tempAsk->getSize(),4),
                    number_format($tempAsk->getBtcVal(),8),
                    number_format($tempAsk->getSum(),8)
                ));

                return $this->json($asksSum);
            }
            else if($method == "BID")
            {
                $bids = $this->getDoctrine()->getRepository(Bid::class)->findBy(['market' => $res->getId()],['value'=> 'DESC']);


                $bidsSum = array();


                $tempBid = new BidSum();

                $sum = 0.0;

                foreach($bids as $bid)
                {
                    //premier ajout
                    if($tempBid->getValue() == 0)
                    {
                        $tempBid->setValue($bid->getValue());
                        $tempBid->setSize($bid->getVolume());
                    }
                    else if($tempBid->getValue() == $bid->getValue())
                    {
                        //ajout du volume
                        $tempBid->setSize($tempBid->getSize() + $bid->getVolume());
                    }
                    else
                    {
                        //sinon nouvelle valeur
                        $tempBid->setBtcVal((float)$tempBid->getSize() * (float)$tempBid->getValue());
                        //echo (float)$tempBid->getSize() * (float)$tempBid->getValue();
                        $sum += (float)$tempBid->getBtcVal();
                        $tempBid->setSum($sum);
                        array_push($bidsSum,array(
                            number_format($tempBid->getSum(),8),
                            number_format($tempBid->getBtcVal(),8),
                            number_format($tempBid->getSize(),4),
                            number_format($tempBid->getValue(),8)
                        ));
                        $tempBid = new BidSum();
                        $tempBid->setValue($bid->getValue());
                        $tempBid->setSize($bid->getVolume());
                    }
                }

                $tempBid->setBtcVal($tempBid->getSize() * $tempBid->getValue());
                $sum += $tempBid->getBtcVal();
                $tempBid->setSum($sum);

                array_push($bidsSum,array(
                    number_format($tempBid->getSum(),8),
                    number_format($tempBid->getBtcVal(),8),
                    number_format($tempBid->getSize(),4),
                    number_format($tempBid->getValue(),8)
                ));
                return $this->json($bidsSum);
            }
            else
            {
                return $this->json(array("Sum"=>"Method not allowed"));
            }








            $coin = $this->getDoctrine()->getRepository(Asset::class)->findOneBy(['id' => $res->getIdAsset()]);

            return $this->render('market/view.html.twig',
                [
                    'bids' => $bidsSum,
                    'asks' => $asksSum,
                    'coin' => $coin,
                    'market' => $res
                ]);
        }

        else
        {
            return $this->json(array('Sum' => 'No Data Available'));
        }
    }
}
