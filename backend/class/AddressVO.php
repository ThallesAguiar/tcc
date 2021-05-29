<?php
class AddressVO
{
    private $id_address;
    private $street;
    private $number;
    private $complement;
    private $district;
    private $city;
    private $state;
    private $country;
    private $zipcode;

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
     * Get the value of street
     *
     * @return  mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set the value of street
     *
     * @param   mixed  $street  
     *
     * @return  self
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Get the value of number
     *
     * @return  mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @param   mixed  $number  
     *
     * @return  self
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get the value of complement
     *
     * @return  mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set the value of complement
     *
     * @param   mixed  $complement  
     *
     * @return  self
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * Get the value of district
     *
     * @return  mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set the value of district
     *
     * @param   mixed  $district  
     *
     * @return  self
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * Get the value of city
     *
     * @return  mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param   mixed  $city  
     *
     * @return  self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the value of zipcode
     *
     * @return  mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set the value of zipcode
     *
     * @param   mixed  $zipcode  
     *
     * @return  self
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get the value of state
     *
     * @return  mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @param   mixed  $state  
     *
     * @return  self
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}
