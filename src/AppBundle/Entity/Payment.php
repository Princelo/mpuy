<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PaymentRepository")
 */
class Payment
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
     * @var integer
     *
     * @ORM\Column(name="recieve_user", type="integer")
     */
    private $recieveUser;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float")
     */
    private $volume;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pay_time", type="datetime")
     */
    private $payTime;

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
     * @return Payment
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
     * Set recieveUser
     *
     * @param integer $recieveUser
     * @return Payment
     */
    public function setRecieveUser($recieveUser)
    {
        $this->recieveUser = $recieveUser;

        return $this;
    }

    /**
     * Get recieveUser
     *
     * @return integer 
     */
    public function getRecieveUser()
    {
        return $this->recieveUser;
    }

    /**
     * Set volume
     *
     * @param float $volume
     * @return Payment
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
     * Set payTime
     *
     * @param \DateTime $payTime
     * @return Payment
     */
    public function setPayTime($payTime)
    {
        $this->payTime = $payTime;

        return $this;
    }

    /**
     * Get payTime
     *
     * @return \DateTime 
     */
    public function getPayTime()
    {
        return $this->payTime;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Payment
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
