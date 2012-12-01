<?php

namespace ProjectBundle\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProjectBundle\Bundle\AdminBundle\Entity\SystemUserRepository")
 * @ORM\Table(name="system_users")
 */
class SystemUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $firstName;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $lastName;

    /** @ORM\Column(type="string", length=100) */
    protected $username;

    /** @ORM\Column(type="string", length=100) */
    protected $password;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $address;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $street;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $apartment;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $country;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $province;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $postalCode;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $role;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    protected $status;

    /** @ORM\Column(type="datetime", nullable=true) */
    protected $lastLogin;

    /** @ORM\Column(type="datetime", nullable=true) */
    protected $createdAt;

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
    }

    public function getApartment()
    {
        return $this->apartment;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }


}