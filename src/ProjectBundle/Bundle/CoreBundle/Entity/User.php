<?php

namespace ProjectBundle\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProjectBundle\Bundle\CoreBundle\Entity\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $username;

    /** @ORM\Column(type="string", length=100) */
    protected $email;

    /** @ORM\Column(type="string", length=100) */
    protected $mobileNumber;

    /** @ORM\Column(type="string", length=100) */
    protected $password;

    /** @ORM\Column(type="string", length=100) */
    protected $roles;

    /** @ORM\Column(type="string", length=100) */
    protected $status;

    /** @ORM\OneToMany(targetEntity="Project", mappedBy="User") */
    protected $projects;

    /** @ORM\OneToMany(targetEntity="Member", mappedBy="User") */
    protected $members;

    /** @ORM\Column(type="datetime") */
    protected $lastLogin;
}