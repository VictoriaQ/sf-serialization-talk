<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as SfSerializer;

/**
 * Spaceship
 *
 * @ORM\Table(name="spaceship")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpaceshipRepository")
 */
class Spaceship
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @SfSerializer\Groups({"list", "show"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     * @SfSerializer\Groups({"list", "show"})
     */
    private $color;

    /**
     * @var int
     *
     * @ORM\Column(name="maxSpeed", type="integer")
     * @SfSerializer\Groups({"list", "show"})
     */
    private $maxSpeed;

    /**
     * @ORM\OneToOne(targetEntity="SpaceMission", inversedBy="spaceship")
     */
    protected $mission;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Spaceship
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Spaceship
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set maxSpeed
     *
     * @param integer $maxSpeed
     *
     * @return Spaceship
     */
    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;

        return $this;
    }

    /**
     * Get maxSpeed
     *
     * @return int
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * Set mission
     *
     * @param \AppBundle\Entity\SpaceMission $mission
     *
     * @return Spaceship
     */
    public function setMission(\AppBundle\Entity\SpaceMission $mission = null)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return \AppBundle\Entity\SpaceMission
     */
    public function getMission()
    {
        return $this->mission;
    }
}
