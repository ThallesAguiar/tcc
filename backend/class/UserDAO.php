<?php

class UserDAO{

    /**
     * Salvar usuário no Banco de dados.
     */
    public function saveUser(UserVO $userVO, $conn){
        $sql = "INSERT INTO `usuario`(`nome`, `sobrenome`, `email`, `empresario`, `status`, `senha`, `data_nascimento`, `genero`, `telefone`, `biografia`, `coordenadas`) 
        VALUES ('".$userVO->getName()."','".$userVO->getLastname()."','".$userVO->getEmail()."','".$userVO->getBusinessman()."','".$userVO->getStatus()."','". md5($userVO->getPassword())."','".$userVO->getBirthday()."','".$userVO->getGender()."','".$userVO->getPhone()."','".$userVO->getBio()."','".$userVO->getCoordinates."'";
        var_dump($sql);    
}
}