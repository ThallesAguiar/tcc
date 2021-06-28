<?php

require_once('../../global/variablesGlobals.php');

class SessionVO
{
    private $email;
    private $password;
    private $token;
    private $secret = SECRET;


    /**
     * Get the value of email of Session
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email in Session
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password of Session
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password in Session
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of token of Session
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token in Session
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of secret of Session
     */ 
    public function getSecret()
    {
        return $this->secret;
    }
}