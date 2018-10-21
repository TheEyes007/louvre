<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:35
 */

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="App\Domain\Repository\CommandRepository")
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commandNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailToken;

    //GETTER AND SETTER

    public function getId()
    {
        return $this->id;
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
     * Get firstname
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * Get dateofbirth
     *
     * @return \DateTime
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
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
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get commandNumber
     *
     * @return string
     */
    public function getCommandnumber()
    {
        return $this->commandNumber;
    }

    /**
     * Get emailToken
     *
     * @return string
     */
    public function getEmailtoken()
    {
        return $this->emailToken;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Command
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Command
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Set dateofbirth
     *
     * @param string $dateofbirth
     *
     * @return Command
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Command
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Command
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Command
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Set commandNumber
     *
     * @param integer $commandNumber
     *
     * @return Command
     */
    public function setCommandnumber($commandNumber)
    {
        $this->commandNumber = $commandNumber;

        return $this;
    }

    /**
     * Set emailToken
     *
     * @param integer $emailToken
     *
     * @return Command
     */
    public function setEmailtoken($emailToken)
    {
        $this->emailToken = $emailToken;

        return $this;
    }
}
