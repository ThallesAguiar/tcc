<?php

class EnterpriseVO
{
    private $id_enterprise;
    private $corporate_name;
    private $fantasy_name;
    private $numbering_company;
    private $numbering_personal;
    private $description;
    private $enterprise_type;
    private $id_address;
    private $active;



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
     * Get the value of corporate_name
     *
     * @return  mixed
     */
    public function getCorporate_name()
    {
        return $this->corporate_name;
    }

    /**
     * Set the value of corporate_name
     *
     * @param   mixed  $corporate_name  
     *
     * @return  self
     */
    public function setCorporate_name($corporate_name)
    {
        $this->corporate_name = $corporate_name;
        return $this;
    }

    /**
     * Get the value of fantasy_name
     *
     * @return  mixed
     */
    public function getFantasy_name()
    {
        return $this->fantasy_name;
    }

    /**
     * Set the value of fantasy_name
     *
     * @param   mixed  $fantasy_name  
     *
     * @return  self
     */
    public function setFantasy_name($fantasy_name)
    {
        $this->fantasy_name = $fantasy_name;
        return $this;
    }

    /**
     * Get the value of numbering_company
     *
     * @return  mixed
     */
    public function getNumbering_company()
    {
        return $this->numbering_company;
    }

    /**
     * Set the value of numbering_company
     *
     * @param   mixed  $numbering_company  
     *
     * @return  self
     */
    public function setNumbering_company($numbering_company)
    {
        $this->numbering_company = $numbering_company;
        return $this;
    }

    /**
     * Get the value of numbering_personal
     *
     * @return  mixed
     */
    public function getNumbering_personal()
    {
        return $this->numbering_personal;
    }

    /**
     * Set the value of numbering_personal
     *
     * @param   mixed  $numbering_personal  
     *
     * @return  self
     */
    public function setNumbering_personal($numbering_personal)
    {
        $this->numbering_personal = $numbering_personal;
        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param   mixed  $description  
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of enterprise_type
     *
     * @return  mixed
     */
    public function getEnterprise_type()
    {
        return $this->enterprise_type;
    }

    /**
     * Set the value of enterprise_type
     *
     * @param   mixed  $enterprise_type  
     *
     * @return  self
     */
    public function setEnterprise_type($enterprise_type)
    {
        $this->enterprise_type = $enterprise_type;
        return $this;
    }

    /**
     * Get the value of id_address
     *
     * @return  mixed
     */
    public function getId_address()
    {
        return $this->id_address;
    }

    /**
     * Set the value of id_address
     *
     * @param   mixed  $id_address  
     *
     * @return  self
     */
    public function setId_address($id_address)
    {
        $this->id_address = $id_address;
        return $this;
    }

    /**
     * Get the value of active
     *
     * @return  mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param   mixed  $active  
     *
     * @return  self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
}
