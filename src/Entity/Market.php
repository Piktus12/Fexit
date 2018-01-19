<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarketRepository")
 */
class Market
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $idAsset;

    /**
     * @ORM\Column(type="string")
     */
    private $lastPrice = "";

    /**
     * @ORM\Column(type="string")
     */
    private $volume = "";

    /**
     * @ORM\Column(type="float", scale=8)
     */
    private $lastBid = 0.0;

    /**
     * @ORM\Column(type="float", scale=8)
     */
    private $lastAsk = 0.0;

    /**
     * @ORM\Column(type="string")
     */
    private $percentChange = "";

    /**
     * @return mixed
     */
    public function getPercentChange()
    {
        return $this->percentChange;
    }

    /**
     * @param mixed $percentChange
     */
    public function setPercentChange($percentChange)
    {
        $this->percentChange = $percentChange;
    }

    /**
     * @return mixed
     */
    public function getLastPrice()
    {
        return $this->lastPrice;
    }

    /**
     * @param mixed $lastPrice
     */
    public function setLastPrice($lastPrice)
    {
        $this->lastPrice = $lastPrice;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getLastBid()
    {
        return $this->lastBid;
    }

    /**
     * @param mixed $lastBid
     */
    public function setLastBid($lastBid)
    {
        $this->lastBid = $lastBid;
    }



    /**
     * @return mixed
     */
    public function getLastAsk()
    {
        return $this->lastAsk;
    }

    /**
     * @param mixed $lastAsk
     */
    public function setLastAsk($lastAsk)
    {
        $this->lastAsk = $lastAsk;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIdAsset()
    {
        return $this->idAsset;
    }

    /**
     * @param mixed $idAsset
     */
    public function setIdAsset($idAsset)
    {
        $this->idAsset = $idAsset;
    }

    // add your own fields
}
