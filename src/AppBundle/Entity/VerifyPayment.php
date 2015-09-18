<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VerifyPayment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VerifyPaymentRepository")
 */
class VerifyPayment
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
     * @var integer
     *
     * @ORM\Column(name="pay_user", type="integer")
     */
    private $payUser;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;


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
     * Set payUser
     *
     * @param integer $payUser
     * @return VerifyPayment
     */
    public function setPayUser($payUser)
    {
        $this->payUser = $payUser;

        return $this;
    }

    /**
     * Get payUser
     *
     * @return integer 
     */
    public function getPayUser()
    {
        return $this->payUser;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return VerifyPayment
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return float 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return VerifyPayment
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
}
