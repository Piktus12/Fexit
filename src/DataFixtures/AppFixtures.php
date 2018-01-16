<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Asset;
use App\Entity\Market;
use App\Entity\User;
use App\Entity\Bid;
use App\Entity\Ask;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        
		$asset = new Asset();
		$asset->setName('Bitcoin');
		$asset->setMnemonic('BTC');
		$asset->setVersus('USDT');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Ethereum');
		$asset->setMnemonic('ETH');
        $asset->setVersus('BTC');
        $manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('LiteCoin');
		$asset->setMnemonic('LTC');
        $asset->setVersus('BTC');
		$manager->persist($asset);
        
		$asset = new Asset();
		$asset->setName('Xverge');
		$asset->setMnemonic('XVG');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Stratis');
		$asset->setMnemonic('STRAT');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Lumen');
		$asset->setMnemonic('XLM');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Ripple');
		$asset->setMnemonic('XRP');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Siacoin');
		$asset->setMnemonic('SC');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('DogeCoin');
		$asset->setMnemonic('DOGE');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('OmiseGo');
		$asset->setMnemonic('OMG');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Bitcoin Cash');
		$asset->setMnemonic('BCC');
		$asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Zcash');
		$asset->setMnemonic('ZEC');
        $asset->setVersus('BTC');
		$manager->persist($asset);
		
		$asset = new Asset();
		$asset->setName('Lisk');
		$asset->setMnemonic('LSK');
        $asset->setVersus('BTC');
		$manager->persist($asset);

        $manager->flush();


		//MARKET
        $repository = $manager->getRepository(Asset::class);
        $asset = $repository->findOneBy(['name' => 'Lisk']);

        $market = new Market();
        $market->setName('LSK-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Zcash']);
        $market = new Market();
        $market->setName('ZEC-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Bitcoin Cash']);
        $market = new Market();
        $market->setName('BCC-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Omisego']);
        $market = new Market();
        $market->setName('OMG-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'DogeCoin']);
        $market = new Market();
        $market->setName('DOGE-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Siacoin']);
        $market = new Market();
        $market->setName('SC-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Ripple']);
        $market = new Market();
        $market->setName('XRP-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Lumen']);
        $market = new Market();
        $market->setName('XLM-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Stratis']);
        $market = new Market();
        $market->setName('STRAT-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Xverge']);
        $market = new Market();
        $market->setName('XVG-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Litecoin']);
        $market = new Market();
        $market->setName('LTC-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);

        $asset = $repository->findOneBy(['name' => 'Ethereum']);
        $market = new Market();
        $market->setName('ETH-BTC');
        $market->setIdAsset($asset->getId());
        $manager->persist($market);






        $user = new User();
        //$user->setUsername("Izu_uzI");
        $user->setFirstname("Paul");
        $user->setLastname("Jacquin");
        $user->setPassword("test");
        $user->setEmail("pjacquin@gmail.com");
        $user->setVerificationKey("$2y$13$8AvtNWperVw2fdBtuuSy5eV.2j4IFO6q5vR4Q.bcn3fA6DcQYll");
        $user->setGoogleAuthenticatorCode("test");
        $manager->persist($user);

        $user = new User();
        //$user->setUsername("Kortex");
        $user->setFirstname("Romain");
        $user->setLastname("Lemoel");
        $user->setEmail("rlemoel@gmail.com");
        $user->setPassword("test2");
        $user->setVerificationKey("$2y$13$8AvtNWperVw2fdBtuuSy5eV.2j4IFO6q5vR4Q.bcn3fA6DcQYll5");
        $user->setGoogleAuthenticatorCode("test2");
        $manager->persist($user);

        $user = new User();
        //$user->setUsername("Piktus");
        $user->setFirstname("Bertrand");
        $user->setLastname("Schvallinger");
        $user->setEmail("bertrand.Schvallinger@gmail.com");
        $user->setPassword("test3");
        $user->setVerificationKey("$2y$13$8AvtNWperVw2fdBtuuSy5eV.2j4IFO6q5vR4Q.bcn3fA6DcQYll5q");
        $user->setGoogleAuthenticatorCode("test3");
        $manager->persist($user);

        $manager->flush();

        $repository = $manager->getRepository(User::class);
        $user1 = $repository->findOneBy(['email' => 'pjacquin@gmail.com']);
        $user2 = $repository->findOneBy(['email' => 'rlemoel@gmail.com']);
        $user3 = $repository->findOneBy(['email' => 'bertrand.Schvallinger@gmail.com']);
        $repository = $manager->getRepository(Market::class);
        $markets = $repository->findAll();

        foreach($markets as $current ) {
            for ($i = 0; $i < 20; $i++) {
                $bid = new Bid();
                $bid->setIdUser($user1->getId());
                $bid->setValue(mt_rand(10, 100));
                $bid->setVolume(mt_rand(100, 600));
                $bid->setMarket($current->getId());
                $date = new \DateTime('c');
                $bid->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($bid);

                $bid = new Bid();
                $bid->setIdUser($user2->getId());
                $bid->setValue(mt_rand(10, 100));
                $bid->setVolume(mt_rand(100, 600));
                $bid->setMarket($current->getId());
                $date = new \DateTime('c');
                $bid->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($bid);

                $bid = new Bid();
                $bid->setIdUser($user3->getId());
                $bid->setValue(mt_rand(10, 100));
                $bid->setVolume(mt_rand(100, 600));
                $bid->setMarket($current->getId());
                $date = new \DateTime('c');
                $bid->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($bid);
            }

            for ($i = 0; $i < 20; $i++) {
                $ask = new Ask();
                $ask->setIdUser($user1->getId());
                $ask->setValue(mt_rand(100, 400));
                $ask->setVolume(mt_rand(600, 1200));
                $ask->setMarket($current->getId());
                $date = new \DateTime('c');
                $ask->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($ask);

                $ask = new Ask();
                $ask->setIdUser($user2->getId());
                $ask->setValue(mt_rand(100, 400));
                $ask->setVolume(mt_rand(600, 1200));
                $ask->setMarket($current->getId());
                $date = new \DateTime('c');
                $ask->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($ask);

                $ask = new Ask();
                $ask->setIdUser($user3->getId());
                $ask->setValue(mt_rand(100, 400));
                $ask->setVolume(mt_rand(600, 1200));
                $ask->setMarket($current->getId());
                $date = new \DateTime('c');
                $ask->setDate($date->setTimestamp($date->getTimestamp() - $i));
                $manager->persist($ask);
            }
        }

        $manager->flush();

        $markets = $manager->getRepository(Market::class)->findAll();
        foreach($markets as $market)
        {
            $bid = $manager->getRepository(Bid::class)->findHighByForAsset($market->getId());
            $market->setLastBid($bid->getValue());

            $ask = $manager->getRepository(Ask::class)->findLowByForAsset($market->getId());
            $market->setLastAsk($ask->getValue());

            $manager->persist($market);

        }

        $manager->flush();
    }
}