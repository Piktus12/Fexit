<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ask", mappedBy="idUser")
     */
    private $asks;

    public function __construct()
    {
        $this->asks = new ArrayCollection();
    }

    /**
     * @return Collection|Ask[]
     */
    public function getAsks()
    {
        return $this->asks;
    // add your own fields
}
