<?php

class HistoryVO
{
    private $id_history;
    private $description;
    private $id_user;

    /**
     * Get the value of id_history
     *
     * @return  mixed
     */
    public function getId_history()
    {
        return $this->id_history;
    }

    /**
     * Set the value of id_history
     *
     * @param   mixed  $id_history  
     *
     * @return  self
     */
    public function setId_history($id_history)
    {
        $this->id_history = $id_history;
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
