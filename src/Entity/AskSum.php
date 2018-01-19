<?php

namespace App\Entity;


class AskSum
{

    private $value = 0;
    private $size = 0;
    private $sum = 0;
    private $btc_val =0;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * @param float $size
     */
    public function setSize(float $size)
    {
        $this->size = $size;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     */
    public function setSum(float $sum)
    {
        $this->sum = $sum;
    }

    /**
     * @return float
     */
    public function getBtcVal(): float
    {
        return $this->btc_val;
    }

    /**
     * @param float $btc_val
     */
    public function setBtcVal(float $btc_val)
    {
        $this->btc_val = $btc_val;
    }




    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    // add your own fields
}
