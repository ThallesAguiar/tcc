<?php

class UserDAO
{

    /**
     * Salvar usuário no Banco de dados.
     */
    public function saveUser(UserVO $userVO, $conn)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `user`(`name`, `lastname`, `email`, `businessman`, `password`, `birthday`, `gender`, `phone`, `bio`, `coordinates`, `lat`,`lng`,`created`) 
        VALUES ('" . $userVO->getName() . "','" . $userVO->getLastname() . "','" . $userVO->getEmail() . "','" . $userVO->getBusinessman() . "','" . md5($userVO->getPassword()) . "','" . $userVO->getBirthday() . "','" . $userVO->getGender() . "','" . $userVO->getPhone() . "','" . $userVO->getBio() . "',ST_GeomFromText('POINT(" . $userVO->getCoordinates() . ")'),'" . $userVO->getLat() . "','" . $userVO->getLng() . "', '$now')";

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
        $usersArray = array();

        $sql = "SELECT id_user, email, name, lastname, birthday, gender, phone, avatar, bio, `status`, businessman, id_enterprise, ST_AsText(coordinates) coordinates, lat, lng  FROM `user`";
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

            $usersArray[] = $users;
        }

        return $usersArray;
    }

    /**
     * Busca um usuário por ID no Banco de dados.
     */
    public static function getUserById($id, $conn)
    {
        $sql = "SELECT id_user, email, name, lastname, birthday, gender, phone, avatar, bio, `status`, businessman, id_enterprise, ST_AsText(coordinates) coordinates, lat, lng  FROM `user` WHERE id_user = $id";
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
        $sql = "UPDATE `user` SET `name`='" . $user->getName() . "',`lastname`='" . $user->getLastname() . "',`email`='" . $user->getEmail() . "', `password`='" . $user->getPassword() . "',`birthday`='" . $user->getBirthday() . "',`gender`='" . $user->getGender() . "',`phone`='" . $user->getPhone() . "',`bio`='" . $user->getBio() . "',`avatar`='" . $user->getAvatar() . "' WHERE `id_user` = " . $user->getId_user() . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Esta função é caso o user na hora do cadastro não queira ser empreendedor.
     */
    public static function ImNotBusinessman($id, $conn)
    {
        $sql = "UPDATE `user` SET `businessman`= 0 WHERE `id_user` = " . $id . "";
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
        // busca user pra ver se ele tem empresa
        $user = UserDAO::getUserById($id, $conn);
        if ($user['id_enterprise'] != null) {
            // busca empresa pra ver se ele tem endereco
            $enterprise = EnterpriseDAO::getEnterpriseById($user['id_enterprise'], $conn);
            if ($enterprise['id_endereco'] != null) {
                $sql = "DELETE FROM `endereco` WHERE `id_endereco` = " . $enterprise['id_endereco'] . "";
                mysqli_query($conn, $sql);
            }
            $sql = "DELETE FROM `empresa` WHERE `id_enterprise` = " . $user['id_enterprise'] . "";
            mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM `user` WHERE `id_user` = $id";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Atualiza as coordinates do usuário
     */
    public static function updateCoordinatesUser(UserVO $user, $conn)
    {
        // $sql = "UPDATE `user` SET `coordinates`= ST_GeomFromText('POINT(" . $user->getCoordinates() . ")') WHERE `id_user` = " . $user->getId_user() . "";
        $sql = "UPDATE `user` SET `lat`= '".$user->getLat() . "', `lng`= '".$user->getLng() . "', `coordinates`= ST_GeomFromText('POINT(" . $user->getCoordinates() . ")') WHERE `id_user` = " . $user->getId_user() . "";
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
        // $sql = "SELECT ST_AsText(coordinates) coordinates  FROM `user` WHERE id_user = $id";
        $sql = "SELECT lat, lng  FROM `user` WHERE id_user = $id";
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
