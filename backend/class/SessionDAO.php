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

    /**
     * Verifica o status online de um usuário
     */
    public static function verifyStatusOnline($id, $conn)
    {
        $sql = "SELECT `end` FROM login WHERE user_id = $id";
        $query = mysqli_query($conn, $sql);

        return mysqli_fetch_assoc($query);
        
    }

    /**
     * Monitora o online do usuario
     */
    public static function online($id, $conn)
    {
        $sql = "SELECT `end` FROM login WHERE user_id = $id";
        $query = mysqli_query($conn, $sql);

        $login = mysqli_fetch_assoc($query);
        date_default_timezone_set('America/Sao_Paulo');
        $data['atual'] = date('Y-m-d H:i:s');
        $data['online'] = strtotime($data['atual'] . "-5 minutes");
        $data['online'] = date('Y-m-d H:i:s', $data['online']);

        if (isset($login) && !empty($login)) {
            $sql_up = "UPDATE login SET `end`='" . $data['atual'] . "' WHERE user_id = $id";
            mysqli_query($conn, $sql_up);
        } else {
            $sql_crt = "INSERT INTO login (`user_id`,`start`,`end`) VALUES ('" . $id . "','" . $data['atual'] . "', '" . $data['atual'] . "')";
            mysqli_query($conn, $sql_crt);
        }
    }
}
