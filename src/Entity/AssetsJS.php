<?php

namespace App\Entity;


class AssetsJS
{
    private $coin_name;
    private $market;
    private $last_price;
    private $volume;
    private $bid;
    private $ask;
    private $change;
    /**
     * @return mixed
     */
    public function getCoinName()
    {
        return $this->coin_name;
    }

    /**
     * @param mixed $coinName
     */
    public function setCoinName($coin_name)
    {
        $this->coin_name = $coin_name;
    }

    /**
     * @return mixed
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param mixed $market
     */
    public function setMarket($market)
    {
        $this->market = $market;
    }

    /**
     * @return mixed
     */
    public function getLastPrice()
    {
        return $this->last_price;
    }

    /**
     * @param mixed $lastPrice
     */
    public function setLastPrice($last_price)
    {
        $this->last_price = $last_price;
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
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param mixed $bid
     */
    public function setBid($bid)
    {
        $this->bid = $bid;
    }

    /**
     * @return mixed
     */
    public function getAsk()
    {
        return $this->ask;
    }

    /**
     * @param mixed $ask
     */
    public function setAsk($ask)
    {
        $this->ask = $ask;
    }

    /**
     * @return mixed
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * @param mixed $change
     */
    public function setChange($change)
    {
        $this->change = $change;
    }


}
