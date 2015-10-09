<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Argument
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ArgumentRepository")
 */
class Argument
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="defendant", type="integer")
     */
    private $defendant;

    /**
     * @var integer
     *
     * @ORM\Column(name="accuser", type="integer")
     */
    private $accuser;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Argument
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Argument
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set defendant
     *
     * @param integer $defendant
     * @return Argument
     */
    public function setDefendant($defendant)
    {
        $this->defendant = $defendant;

        return $this;
    }

    /**
     * Get defendant
     *
     * @return integer 
     */
    public function getDefendant()
    {
        return $this->defendant;
    }

    /**
     * Set accuser
     *
     * @param integer $accuser
     * @return Argument
     */
    public function setAccuser($accuser)
    {
        $this->accuser = $accuser;

        return $this;
    }

    /**
     * Get accuser
     *
     * @return integer 
     */
    public function getAccuser()
    {
        return $this->accuser;
    }
}
