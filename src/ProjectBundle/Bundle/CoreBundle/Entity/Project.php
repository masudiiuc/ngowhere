<?php

namespace ProjectBundle\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProjectBundle\Bundle\CoreBundle\Entity\ProjectRepository")
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $name;

    /** @ORM\Column(type="text") */
    protected $description;

    /** @ORM\Column(type="string", length=100) */
    protected $status;

    /** @ORM\ManyToOne(targetEntity="User") */
    protected $user;

    /** @ORM\OneToMany(targetEntity="Activity", mappedBy="projects") */
    protected $activities;

    /** @ORM\ManyToMany(targetEntity="Member", inversedBy="projects") */
    protected $members;

}