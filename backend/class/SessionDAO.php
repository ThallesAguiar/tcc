<?php
require_once('../vendor/autoload.php');

use Firebase\JWT\JWT;


class SessionDAO
{
    public function verifiryUser(UserVO $user, $conn)
    {
        $sql = "SELECT email,nome,biografia, senha, id_usuario, empresario, id_empresa, ST_AsText(coordenadas) coordenadas  FROM `usuario` WHERE `email` = '" . $user->getEmail() . "'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 user not exists!');
            echo json_encode(["error" => "User not exists!"]);
            return false;
        }

        $values = mysqli_fetch_assoc($query);

        if (md5($user->getPassword()) != $values['senha']) {
            header('HTTP/1.1 400 passwords not match!');
            echo json_encode(["error" => "Passwords not match!"]);
            return false;
        }

        $user->setName($values['nome']);
        $user->setBio($values['biografia']);
        $user->setPassword(null);
        $user->setId_user($values['id_usuario']);
        $user->setBusinessman($values['empresario']);
        $user->setId_enterprise($values['id_empresa']);
        $user->setCoordinates($values['coordenadas']);

        return true;
    }

    /**
     * Create a token for auth
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
     * Verify if token is valid
     */
    public function verifyAuth($token)
    {
        $auth = new SessionVO;

        if ($token) {
            $decoded = JWT::decode($token, $auth->getSecret(), array('HS256'));

            if ($decoded) {
                return $decoded;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
