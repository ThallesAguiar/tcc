<?php

class UserVO
{
    private $id_user;
    private $name;
    private $lastname;
    private $email;
    private $businessman;
    private $status;
    private $password;
    private $birthday;
    private $gender;
    private $phone;
    private $bio;
    private $id_enterprise;
    private $avatar;
    private $coordinates;

    /**
     * Get the value of id_user
     *
     * @return  mixed
     */
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @param   mixed  $id_user  
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * Get the value of name
     *
     * @return  mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param   mixed  $name  
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param   mixed  $lastname  
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param   mixed  $email  
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of businessman
     *
     * @return  mixed
     */
    public function getBusinessman()
    {
        return $this->businessman;
    }

    /**
     * Set the value of businessman
     *
     * @param   mixed  $businessman  
     *
     * @return  self
     */
    public function setBusinessman($businessman)
    {
        $this->businessman = $businessman;
        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param   mixed  $status  
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param   mixed  $password  
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of birthday
     *
     * @return  mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @param   mixed  $birthday  
     *
     * @return  self
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get the value of gender
     *
     * @return  mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @param   mixed  $gender  
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get the value of phone
     *
     * @return  mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param   mixed  $phone  
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get the value of bio
     *
     * @return  mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @param   mixed  $bio  
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the value of id_enterprise
     *
     * @return  mixed
     */
    public function getId_enterprise()
    {
        return $this->id_enterprise;
    }

    /**
     * Set the value of id_enterprise
     *
     * @param   mixed  $id_enterprise  
     *
     * @return  self
     */
    public function setId_enterprise($id_enterprise)
    {
        $this->id_enterprise = $id_enterprise;
        return $this;
    }

    /**
     * Get the value of avatar
     *
     * @return  mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param   mixed  $avatar  
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get the value of coordinates
     *
     * @return  mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Set the value of coordinates
     *
     * @param   mixed  $coordinates  
     *
     * @return  self
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
        return $this;
    }
}
