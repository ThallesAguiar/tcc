<?php

class AddressDAO
{
    /**
     * Salva endereço na tabela empresa.
     */
    public static function saveAddress(AddressVO $addressVO, $conn, $id_enterprise = null)
    {
        $sql = "INSERT INTO `endereco`(`logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`,`pais`, `zipcode`) 
        VALUES ('" . $addressVO->getStreet() . "','" . $addressVO->getNumber() . "','" . $addressVO->getComplement() . "','" . $addressVO->getDistrict() . "','" . $addressVO->getCity() . "','" . $addressVO->getState() . "','" . $addressVO->getCountry() . "','" . $addressVO->getZipcode() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        /**pega o id do endereço criado e salva na empresa que criou */
        $addressVO->setId_address(mysqli_insert_id($conn));

        $sql = "UPDATE `empresa` SET `id_endereco`='" . $addressVO->getId_address() . "' WHERE `id_empresa` = " . $id_enterprise  . "";
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
        $sql = "SELECT * FROM `endereco` WHERE id_endereco = $id";
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
     * Atualiza endereço da empresa.
     */
    public static function updateAddressById(AddressVO $addressVO, $conn)
    {
        $sql = "UPDATE `endereco` SET `logradouro`='" . $addressVO->getStreet() . "',`numero`='" . $addressVO->getNumber() . "',`complemento`='" . $addressVO->getComplement() . "',`bairro`='" . $addressVO->getDistrict() . "',`cidade`='" . $addressVO->getCity() . "',`estado`='" . $addressVO->getState() . "',`pais`='" . $addressVO->getCountry() . "',`zipcode`='" . $addressVO->getZipcode() . "' WHERE '" . $addressVO->getId_address() . "'";
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

        $sql = "SELECT * FROM `endereco`";
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
            $address->setId_address(stripslashes($addresses['id_endereco']));
            $address->setStreet(stripslashes($addresses['logradouro']));
            $address->setNumber(stripslashes($addresses['numero']));
            $address->setComplement(stripslashes($addresses['complemento']));
            $address->setDistrict(stripslashes($addresses['bairro']));
            $address->setCity(stripslashes($addresses['cidade']));
            $address->setState(stripslashes($addresses['estado']));
            $address->setCountry(stripslashes($addresses['pais']));
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
        $sqlE = "SELECT id_empresa FROM empresa WHERE id_endereco = $id";
        $enterprise = mysqli_fetch_assoc(mysqli_query($conn, $sqlE));

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `empresa` SET `id_endereco`= null WHERE `id_empresa` = " . $enterprise['id_empresa'] . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "DELETE FROM `endereco` WHERE `id_endereco` = $id";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }
}
