<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * SpaceMission
 *
 * @ORM\Table(name="space_mission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SpaceMissionRepository")
 * @JMS\ExclusionPolicy("all")
 */
class SpaceMission
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
     * @JMS\Expose
     * @JMS\SerializedName("mission")
     * @JMS\Groups({"list", "show"})
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="budget", type="float", nullable=true)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @JMS\Expose
     * @JMS\Groups({"show"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     * @JMS\Expose
     * @JMS\Accessor(getter="getThumbnail")
     * @JMS\Groups({"list", "show"})
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255)
     * @JMS\Since("2.0")
     * @JMS\Expose
     * @JMS\Groups({"list", "show"})
     */
    private $twitter;

    /**
     * @ORM\OneToOne(targetEntity="Spaceship", mappedBy="mission", cascade="persist")
     */
    protected $spaceship;

    /**
      * @JMS\VirtualProperty
      * @JMS\Expose
      * @JMS\SerializedName("spaceship")
      * @JMS\Groups({"list", "show"})
      */
    public function getSpaceshipName()
    {
            return $this->spaceship->getName();
    }

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
     * @return SpaceMission
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
     * Set budget
     *
     * @param float $budget
     *
     * @return SpaceMission
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return SpaceMission
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return SpaceMission
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return 'thumb_'.$this->logo;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return SpaceMission
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set spaceship
     *
     * @param \AppBundle\Entity\Spaceship $spaceship
     *
     * @return SpaceMission
     */
    public function setSpaceship(\AppBundle\Entity\Spaceship $spaceship = null)
    {
        $this->spaceship = $spaceship;
        $spaceship->setSpaceMission($this);

        return $this;
    }

    /**
     * Get spaceship
     *
     * @return \AppBundle\Entity\Spaceship
     */
    public function getSpaceship()
    {
        return $this->spaceship;
    }
}
