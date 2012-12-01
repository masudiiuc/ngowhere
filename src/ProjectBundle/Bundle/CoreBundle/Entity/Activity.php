<?php

namespace ProjectBundle\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProjectBundle\Bundle\CoreBundle\Entity\ActivityRepository")
 * @ORM\Table(name="activities")
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="text") */
    protected $description;

    /** @ORM\ManyToOne(targetEntity="Member") */
    protected $member;

    /** @ORM\ManyToOne(targetEntity="Project") */
    protected $project;

}