<?php

class UserDAO
{

    /**
     * Salvar usuário no Banco de dados.
     */
    public function saveUser(UserVO $userVO, $conn)
    {
        $sql = "INSERT INTO `usuario`(`nome`, `sobrenome`, `email`, `empresario`, `senha`, `data_nascimento`, `genero`, `telefone`, `biografia`, `coordenadas`) 
        VALUES ('" . $userVO->getName() . "','" . $userVO->getLastname() . "','" . $userVO->getEmail() . "','" . $userVO->getBusinessman() . "','" . md5($userVO->getPassword()) . "','" . $userVO->getBirthday() . "','" . $userVO->getGender() . "','" . $userVO->getPhone() . "','" . $userVO->getBio() . "',ST_GeomFromText('POINT(" . $userVO->getCoordinates() . ")'))";

        mysqli_query($conn, $sql);
    }

    /**
     * Busca todos os usuário no Banco de dados.
     */
    public static function getAllUsers($conn)
    {
        $user = new UserVO;
        $usersArray = array();

        $sql = "SELECT id_usuario, email, nome, sobrenome, data_nascimento, genero, telefone, avatar, biografia, `status`,  senha, empresario, id_empresa, ST_AsText(coordenadas) coordenadas  FROM `usuario`";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 users not exists!');
            echo json_encode(["error" => "Users not exists!"]);
            die();
        }

        while ($users = mysqli_fetch_array($query, true)) {
            $user->setId_user(stripslashes($users['id_usuario']));
            $user->setEmail(stripslashes($users['email']));
            $user->setName(stripslashes($users['nome']));
            $user->setLastname(stripslashes($users['sobrenome']));
            $user->setBirthday(stripslashes($users['data_nascimento']));
            $user->setGender(stripslashes($users['genero']));
            $user->setPhone(stripslashes($users['telefone']));
            $user->setAvatar(stripslashes($users['avatar']));
            $user->setBio(stripslashes($users['biografia']));
            $user->setStatus(stripslashes($users['status']));
            $user->setPassword(stripslashes($users['senha']));
            $user->setBusinessman(stripslashes($users['empresario']));
            $user->setId_enterprise(stripslashes($users['id_empresa']));
            $user->setCoordinates(stripslashes($users['coordenadas']));

            $usersArray[] = clone $user;
        }

        return $usersArray;
    }

    /**
     * Busca um usuário por ID no Banco de dados.
     */
    public static function getUserById($id, $conn)
    {
        $sql = "SELECT id_usuario, email, nome, sobrenome, data_nascimento, genero, telefone, avatar, biografia, `status`,  senha, empresario, id_empresa, ST_AsText(coordenadas) coordenadas  FROM `usuario` WHERE id_usuario = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            echo json_encode(["error" => "User not exist!"]);
            header('HTTP/1.1 400 user not exist!');
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Atualiza um usuário por ID no Banco de dados.
     */
    public static function updateUserById(UserVO $user, $conn)
    {
        $sql = "UPDATE `usuario` SET `id_usuario`='[value-1]',`nome`='[value-2]',`sobrenome`='[value-3]',`email`='[value-4]',`empresario`='[value-5]',`status`='[value-6]',`senha`='[value-7]',`data_nascimento`='[value-8]',`genero`='[value-9]',`telefone`='[value-10]',`biografia`='[value-11]',`id_empresa`='[value-12]',`avatar`='[value-13]',`coordenadas`='[value-14]' WHERE id_usuario = ".$user->getId_user()."";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            echo json_encode(["error" => "User not exist!"]);
            header('HTTP/1.1 400 user not exist!');
            die();
        }

        return mysqli_fetch_assoc($query);
    }
}
