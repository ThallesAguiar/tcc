<?php

class EnterpriseVO
{
    private $id_enterprise;
    private $company_name;
    private $fantasy_name;
    private $number_pj;
    private $number_pf;
    private $description;
    private $ativo;
    private $type_company;
    private $id_address;

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
     * Get the value of company_name
     *
     * @return  mixed
     */
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @param   mixed  $company_name  
     *
     * @return  self
     */
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;
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
     * Get the value of number_pj
     *
     * @return  mixed
     */
    public function getNumber_pj()
    {
        return $this->number_pj;
    }

    /**
     * Set the value of number_pj
     *
     * @param   mixed  $number_pj  
     *
     * @return  self
     */
    public function setNumber_pj($number_pj)
    {
        $this->number_pj = $number_pj;
        return $this;
    }

    /**
     * Get the value of number_pf
     *
     * @return  mixed
     */
    public function getNumber_pf()
    {
        return $this->number_pf;
    }

    /**
     * Set the value of number_pf
     *
     * @param   mixed  $number_pf  
     *
     * @return  self
     */
    public function setNumber_pf($number_pf)
    {
        $this->number_pf = $number_pf;
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
     * Get the value of type_company
     *
     * @return  mixed
     */
    public function getType_company()
    {
        return $this->type_company;
    }

    /**
     * Set the value of type_company
     *
     * @param   mixed  $type_company  
     *
     * @return  self
     */
    public function setType_company($type_company)
    {
        $this->type_company = $type_company;
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
     * Get the value of ativo
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @return  self
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }
}
