<?php

class SocialNetworkVO
{
    private $id_social_network;
    private $name;
    private $link;
    private $id_user;

    /**
     * Get the value of id_social_network
     *
     * @return  mixed
     */
    public function getId_social_network()
    {
        return $this->id_social_network;
    }

    /**
     * Set the value of id_social_network
     *
     * @param   mixed  $id_social_network  
     *
     * @return  self
     */
    public function setId_social_network($id_social_network)
    {
        $this->id_social_network = $id_social_network;
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
     * Get the value of link
     *
     * @return  mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @param   mixed  $link  
     *
     * @return  self
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

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
}
