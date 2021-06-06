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

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
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

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 users not exists!');
            echo json_encode(["error" => true, "msg" => "Users not exists!"]);
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
        $sql = "SELECT id_usuario, email, nome, sobrenome, data_nascimento, genero, telefone, avatar, biografia, `status`, empresario, id_empresa, ST_AsText(coordenadas) coordenadas  FROM `usuario` WHERE id_usuario = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 user not exist!');
            ob_clean();
            echo json_encode(["error" => true, "msg" => "User not exist!"]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Atualiza um usuário por ID no Banco de dados.
     */
    public static function updateUserById(UserVO $user, $conn)
    {
        $sql = "UPDATE `usuario` SET `nome`='" . $user->getName() . "',`sobrenome`='" . $user->getLastname() . "',`email`='" . $user->getEmail() . "', `senha`='" . $user->getPassword() . "',`data_nascimento`='" . $user->getBirthday() . "',`genero`='" . $user->getGender() . "',`telefone`='" . $user->getPhone() . "',`biografia`='" . $user->getBio() . "',`avatar`='" . $user->getAvatar() . "' WHERE `id_usuario` = " . $user->getId_user() . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Esta função é caso o usuario na hora do cadastro não queira ser empreendedor.
     */
    public static function ImNotBusinessman($id, $conn)
    {
        $sql = "UPDATE `usuario` SET `empresario`= 0 WHERE `id_usuario` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Deleta um usuário por ID e seus dados estrangeiros. Deleta em cascata.
     */
    public static function deleteUserById($id, $conn)
    {
        // busca usuario pra ver se ele tem empresa
        $user = UserDAO::getUserById($id, $conn);
        if ($user['id_empresa'] != null) {
            // busca empresa pra ver se ele tem endereco
            $enterprise = EnterpriseDAO::getEnterpriseById($user['id_empresa'], $conn);
            if ($enterprise['id_endereco'] != null) {
                $sql = "DELETE FROM `endereco` WHERE `id_endereco` = " . $enterprise['id_endereco'] . "";
                mysqli_query($conn, $sql);
            }
            $sql = "DELETE FROM `empresa` WHERE `id_empresa` = " . $user['id_empresa'] . "";
            mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM `usuario` WHERE `id_usuario` = $id";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Atualiza as coordenadas do usuário
     */
    public static function updateCoordinatesUser(UserVO $user, $conn)
    {
        $sql = "UPDATE `usuario` SET `coordenadas`= ST_GeomFromText('POINT(" . $user->getCoordinates() . ")') WHERE `id_usuario` = " . $user->getId_user() . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Busca coordinadas do usuário
     */
    public static function getCoordinates($id, $conn)
    {
        $sql = "SELECT ST_AsText(coordenadas) coordenadas  FROM `usuario` WHERE id_usuario = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 user not exist!');
            ob_clean();
            echo json_encode(["error" => true, "msg" => "User not exist!"]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }
}
