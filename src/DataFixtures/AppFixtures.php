<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Asset;
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
		
        $manager->flush();
    }
}