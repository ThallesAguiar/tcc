<?php

class SocialNetworkDAO
{
    /**
     * Salva rede social .
     */
    public static function save(SocialNetworkVO $socialNetworkVO, $conn)
    {
        $sql = "INSERT INTO `social_network`(`id_user`, `name`, `link`,`icon` ) 
        VALUES ('" . $socialNetworkVO->getId_user() . "','" . $socialNetworkVO->getName() . "', '" . $socialNetworkVO->getLink() . "','" . $socialNetworkVO->getIcon() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 200 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        return true;
    }

    /**
     * Busca todos as historias no Banco de dados.
     */
    public static function getAllByUser($id, $conn)
    {
        $socialNetworksArray = array();

        $sql = "SELECT * FROM `social_network` WHERE `id_user` = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 200 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 200 Empty');
            ob_clean();
            echo json_encode(["empty" => true, "msg" => "User not have a Social network"]);
            die();
        }

        while ($social_networks = mysqli_fetch_array($query, true)) {
            $socialNetworksArray[] = $social_networks;
        }

        return $socialNetworksArray;
    }

    /**
     * Busca uma rede social por ID social_network no Banco de dados.
     */
    public static function getById($id, $conn)
    {
        $sql = "SELECT * FROM `social_network` WHERE id_social_network = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 200 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Atualiza uma rede social por ID social_network no Banco de dados.
     */
    public static function update(SocialNetworkVO $social_network, $conn)
    {
        $sql = "UPDATE `social_network` SET `name`='" . $social_network->getName() . "', `link`='" . $social_network->getLink() . "',`icon`='" . $social_network->getIcon() . "' WHERE `id_social_network` = " . $social_network->getId_social_network() . "";
        // var_dump($sql);die();

        if (mysqli_error($conn)) {
            header('HTTP/1.1 200 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        return mysqli_query($conn, $sql);
    }

    /**
     * Exclui uma rede social por ID social_network no Banco de dados.
     */
    public static function delete($id, $conn)
    {
        $sql = "DELETE FROM `social_network` WHERE `id_social_network` =  $id";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 200 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }
}
