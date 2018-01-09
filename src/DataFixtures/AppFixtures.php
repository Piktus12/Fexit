<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Asset;
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
		$asset->setName('Bicoin Cash');
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

		$user = new User();
        $user->setName("Paul");
        $user->setSurname("Jacquin");
        $manager->persist($user);

        $user = new User();
        $user->setName("Romain");
        $user->setSurname("Lemoel");
        $manager->persist($user);

        $user = new User();
        $user->setName("Bertrand");
        $user->setSurname("Schvallinger");
        $manager->persist($user);

        $manager->flush();

        $repository = $manager->getRepository(User::class);
        $user1 = $repository->findOneBy(['name' => 'Paul']);
        $user2 = $repository->findOneBy(['name' => 'Romain']);
        $user3 = $repository->findOneBy(['name' => 'Bertrand']);
        $repository = $manager->getRepository(Asset::class);
        $asset = $repository->findOneBy(['name' => 'LiteCoin']);

        for($i =0; $i< 20;$i++)
        {
            $bid = new Bid();
            $bid->setIdUser($user1->getId());
            $bid->setValue(mt_rand(10, 100));
            $bid->setVolume(mt_rand(100, 600));
            $bid->setAsset($asset->getId());
            $date = new \DateTime('c');
            $bid->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($bid);

            $bid = new Bid();
            $bid->setIdUser($user2->getId());
            $bid->setValue(mt_rand(10, 100));
            $bid->setVolume(mt_rand(100, 600));
            $bid->setAsset($asset->getId());
            $date = new \DateTime('c');
            $bid->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($bid);

            $bid = new Bid();
            $bid->setIdUser($user3->getId());
            $bid->setValue(mt_rand(10, 100));
            $bid->setVolume(mt_rand(100, 600));
            $bid->setAsset($asset->getId());
            $date = new \DateTime('c');
            $bid->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($bid);
        }

        for($i =0; $i< 20;$i++)
        {
            $ask = new Ask();
            $ask->setIdUser($user1->getId());
            $ask->setValue(mt_rand(10, 100));
            $ask->setVolume(mt_rand(600, 1200));
            $ask->setAsset($asset->getId());
            $date = new \DateTime('c');
            $ask->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($ask);

            $ask = new Ask();
            $ask->setIdUser($user2->getId());
            $ask->setValue(mt_rand(10, 100));
            $ask->setVolume(mt_rand(600, 1200));
            $ask->setAsset($asset->getId());
            $date = new \DateTime('c');
            $ask->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($ask);

            $ask = new Ask();
            $ask->setIdUser($user3->getId());
            $ask->setValue(mt_rand(10, 100));
            $ask->setVolume(mt_rand(600, 1200));
            $ask->setAsset($asset->getId());
            $date = new \DateTime('c');
            $ask->setDate($date->setTimestamp($date->getTimestamp()-$i));
            $manager->persist($ask);
        }

        $manager->flush();
    }
}