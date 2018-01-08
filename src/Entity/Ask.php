<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AskRepository")
 */
class Ask
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="asks")
     */
    private $idUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $date;


    public function getIdUser(): User
    {
        return $this->idUser;
    }

    public function setCategory(User $idUser)
    {
        $this->category = $category;
    }


    // add your own fields
}
