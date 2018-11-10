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
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="App\Domain\Repository\TicketsRepository")
 */
class Tickets
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
     * @ORM\ManyToOne(targetEntity="Command")
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     */
    private $commandid;

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
     * @ORM\Column(type="string", length=100)
     */
    private $tarif;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateofbooking;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

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
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Get dateofbooking
     *
     * @return \DateTime
     */
    public function getDateofbooking()
    {
        return $this->dateofbooking;
    }

    /**
     * Get commandid
     *
     * @return integer
     */
    public function getCommandid()
    {
        return $this->commandid;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return tickets
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
     * @return tickets
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
     * @return tickets
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return tickets
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Set dateofbooking
     *
     * @param string $dateofbooking
     *
     * @return tickets
     */
    public function setDateofbooking($dateofbooking)
    {
        $this->dateofbooking = $dateofbooking;

        return $this;
    }

    /**
     * Set commandid
     *
     * @param integer $commandid
     *
     * @return tickets
     */
    public function setCommandid(Command $id)
    {
        $this->commandid = $id;

        return $this;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return tickets
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return tickets
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }
}
