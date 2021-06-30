<?php

class AddressDAO
{
    /**
     * Salva endereço na tabela enterprise.
     */
    public static function saveAddress(AddressVO $addressVO, $conn, $id_enterprise = null)
    {
        $sql = "INSERT INTO `address`(`street`, `number`, `complement`, `district`, `city`, `state`,`country`, `zipcode`) 
        VALUES ('" . $addressVO->getStreet() . "','" . $addressVO->getNumber() . "','" . $addressVO->getComplement() . "','" . $addressVO->getDistrict() . "','" . $addressVO->getCity() . "','" . $addressVO->getState() . "','" . $addressVO->getCountry() . "','" . $addressVO->getZipcode() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        /**pega o id do endereço criado e salva na enterprise que criou */
        $addressVO->setId_address(mysqli_insert_id($conn));

        $sql = "UPDATE `enterprise` SET `id_address`='" . $addressVO->getId_address() . "' WHERE `id_enterprise` = " . $id_enterprise  . "";
        mysqli_query($conn, $sql);
        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Busca um endereço por ID.
     */
    public static function getAddressById($id, $conn)
    {
        $sql = "SELECT * FROM `address` WHERE id_address = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 address not exist!');
            ob_clean();
            echo json_encode(["error" => true, "msg" => "Address not exist!"]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Atualiza endereço da enterprise.
     */
    public static function updateAddressById(AddressVO $addressVO, $conn)
    {
        $sql = "UPDATE `address` SET `street`='" . $addressVO->getStreet() . "',`number`='" . $addressVO->getNumber() . "',`complement`='" . $addressVO->getComplement() . "',`district`='" . $addressVO->getDistrict() . "',`city`='" . $addressVO->getCity() . "',`state`='" . $addressVO->getState() . "',`country`='" . $addressVO->getCountry() . "',`zipcode`='" . $addressVO->getZipcode() . "' WHERE `id_address` = '" . $addressVO->getId_address() . "'";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Busca todos os endereços no Banco de dados.
     */
    public static function getAllAddresses($conn)
    {
        $address = new AddressVO;
        $addressesArray = array();

        $sql = "SELECT * FROM `address`";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 addresses not exists!');
            echo json_encode(["error" => true, "msg" => "Addresses not exists!"]);
            die();
        }

        while ($addresses = mysqli_fetch_array($query, true)) {
            $address->setId_address(stripslashes($addresses['id_address']));
            $address->setStreet(stripslashes($addresses['street']));
            $address->setNumber(stripslashes($addresses['number']));
            $address->setComplement(stripslashes($addresses['complement']));
            $address->setDistrict(stripslashes($addresses['district']));
            $address->setCity(stripslashes($addresses['city']));
            $address->setState(stripslashes($addresses['state']));
            $address->setCountry(stripslashes($addresses['country']));
            $address->setZipcode(stripslashes($addresses['zipcode']));

            $addressesArray[] = clone $address;
        }

        return $addressesArray;
    }

    /**
     * Deleta um usuário por ID e seus dados estrangeiros. Deleta em cascata.
     */
    public static function deleteAddressById($id, $conn)
    {
        $sqlE = "SELECT id_enterprise FROM enterprise WHERE id_address = $id";
        $enterprise = mysqli_fetch_assoc(mysqli_query($conn, $sqlE));

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `enterprise` SET `id_address`= null WHERE `id_enterprise` = " . $enterprise['id_enterprise'] . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "DELETE FROM `address` WHERE `id_address` = $id";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }
}
