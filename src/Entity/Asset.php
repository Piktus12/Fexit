<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
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
     * @ORM\Column(type="string", length=100)
	 * @Assert\NotBlank()
     */
    private $mnemonic;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $versus;
	
	public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
	
	public function getMnemonic()
    {
        return $this->mnemonic;
    }

    public function setMnemonic($mnemonic)
    {
        $this->mnemonic = $mnemonic;
    }

    public function getVersus()
    {
        return $this->versus;
    }

    public function setVersus($versus)
    {
        $this->versus = $versus;
    }

}
