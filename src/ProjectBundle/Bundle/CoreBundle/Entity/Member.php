<?php

namespace ProjectBundle\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProjectBundle\Bundle\CoreBundle\Entity\MemberRepository")
 * @ORM\Table(name="members")
 */
class Member
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
    protected $status;

    /** @ORM\ManyToOne(targetEntity="User") */
    protected $user;

    /** @ORM\ManyToMany(targetEntity="Project", mappedBy="members") */
    protected $projects;

    /** @ORM\OneToMany(targetEntity="Activity", mappedBy="Member") */
    protected $activities;

}