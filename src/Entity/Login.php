<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoginRepository")
 */
class Login implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acctype;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAcctype(): ?string
    {
        return $this->acctype;
    }

    public function setAcctype(string $acctype): self
    {
        $this->acctype = $acctype;

        return $this;
    }

    public function __toString(){
        return json_encode([
            "id"=> $this->getId(),
            "username" => $this->getUsername(),
            "acctype"=> $this->getAcctype()
        ]);  
    }

    public function jsonSerialize()
    {
        return [
            "id"=> $this->getId(),
            "username" => $this->getUsername(),
            "acctype"=> $this->getAcctype()
        ];
    }
}
