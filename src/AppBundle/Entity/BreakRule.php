<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BreakRule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BreakRuleRepository")
 */
class BreakRule
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
     * @ORM\Column(name="order_id", type="integer")
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="breaker", type="integer")
     */
    private $breaker;

    /**
     * @var integer
     *
     * @ORM\Column(name="victim", type="integer")
     */
    private $victim;


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
     * @return BreakRule
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
     * @return BreakRule
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
     * Set orderId
     *
     * @param integer $orderId
     * @return BreakRule
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set breaker
     *
     * @param integer $breaker
     * @return BreakRule
     */
    public function setBreaker($breaker)
    {
        $this->breaker = $breaker;

        return $this;
    }

    /**
     * Get breaker
     *
     * @return integer 
     */
    public function getBreaker()
    {
        return $this->breaker;
    }

    /**
     * Set victim
     *
     * @param integer $victim
     * @return BreakRule
     */
    public function setVictim($victim)
    {
        $this->victim = $victim;

        return $this;
    }

    /**
     * Get victim
     *
     * @return integer 
     */
    public function getVictim()
    {
        return $this->victim;
    }
}
