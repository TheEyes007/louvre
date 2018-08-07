<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/08/2018
 * Time: 21:02
 */

namespace App\DTO;


class usersParams
{
    public $name;
    public $firstname;
    public $dateofbirth;
    public $email;

    public function getName(){
        return $this->name;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getDateofbirth(){
        return $this->dateofbirth;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setFirstname($firstname){
        $this->firstname = $firstname;
        return $this;
    }

    public function setDateofbirth($dateofbirth){
        $this->dateofbirth = $dateofbirth;
        return $this;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
}