<?php
require_once('../../vendor/autoload.php');

use Firebase\JWT\JWT;


class SessionDAO
{
    /**
     * Faz verificação em user através de email
     */
    public function verifiryUser(UserVO $user, $conn)
    {
        $sql = "SELECT email,name,bio, password, id_user, businessman, id_enterprise, ST_AsText(coordinates) coordinates  FROM `user` WHERE `email` = '" . $user->getEmail() . "'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 user not exists!');
            echo json_encode(["error" => "User not exists!"]);
            die();
        }

        $values = mysqli_fetch_assoc($query);

        if (md5($user->getPassword()) != $values['password']) {
            header('HTTP/1.1 400 passwords not match!');
            echo json_encode(["error" => "Passwords not match!"]);
            die();
        }

        $user->setName($values['name']);
        $user->setBio($values['bio']);
        $user->setPassword(null);
        $user->setId_user($values['id_user']);
        $user->setBusinessman($values['businessman']);
        $user->setId_enterprise($values['id_enterprise']);
        $user->setCoordinates($values['coordinates']);

        return true;
    }

    /**
     * Cria um token de autentificação
     */
    public function createToken(UserVO $user)
    {
        $auth = new SessionVO;

        $payload = array(
            "id" => $user->getId_user(),
            "email" => $user->getEmail(),
            "businessman" => $user->getBusinessman(),
            "id_enterprise" => $user->getId_enterprise(),
        );

        $jwt = JWT::encode($payload, $auth->getSecret());
        return $jwt;
    }

    /**
     * Verifica se o token é valido
     */
    public function verifyAuth($token)
    {
        $auth = new SessionVO;

        $decoded = JWT::decode($token, $auth->getSecret(), array('HS256'));

        if (!$decoded) {
            return false;
        }

        return $decoded;
    }
}
