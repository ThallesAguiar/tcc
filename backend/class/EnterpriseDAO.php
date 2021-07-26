<?php

class EnterpriseDAO
{
    /**
     * Salvar empresa no Banco de dados.
     */
    public function saveEnterprise(EnterpriseVO $enterpriseVO, $id_user, $conn)
    {
        $sql = "INSERT INTO `enterprise`(`corporate_name`, `fantasy_name`, `numbering_company`, `numbering_personal`, `description`,`enterprise_type`) 
        VALUES ('" . $enterpriseVO->getCorporate_name() . "','" . $enterpriseVO->getFantasy_name() . "','" . $enterpriseVO->getNumbering_company() . "','" . $enterpriseVO->getNumbering_personal() . "','" . $enterpriseVO->getDescription() . "','" . $enterpriseVO->getEnterprise_type() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        /**pega o id da empresa criada e salva no usuario que criou */
        $enterpriseVO->setId_enterprise(mysqli_insert_id($conn));

        $sql = "UPDATE `user` SET `businessman`= 1,`id_enterprise`='" . $enterpriseVO->getId_enterprise() . "' WHERE `id_user` = " . $id_user  . "";
        mysqli_query($conn, $sql);
        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Atualiza uma empresa por ID
     */
    public static function updateEnterpriseById(EnterpriseVO $enterpriseVO, $conn)
    {
        $sql = "UPDATE `enterprise` SET `corporate_name`='" . $enterpriseVO->getCorporate_name() . "',`fantasy_name`='" . $enterpriseVO->getFantasy_name() . "',`numbering_company`='" . $enterpriseVO->getNumbering_company() . "',`numbering_personal`='" . $enterpriseVO->getNumbering_personal() . "',`description`='" . $enterpriseVO->getDescription() . "',`enterprise_type`='" . $enterpriseVO->getEnterprise_type() . "' WHERE `id_enterprise` = " . $enterpriseVO->getId_enterprise() . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Busca uma empresa por ID.
     */
    public static function getEnterpriseById($id, $conn)
    {
        $sql = "SELECT * FROM `enterprise` WHERE id_enterprise = $id";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 enterprise not exist!');
            ob_clean();
            echo json_encode(["error" => true, "msg" => "Enterprise not exist!"]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Busca todos as empresas no Banco de dados.
     */
    public static function getAllEnterprises($conn)
    {
        $enterprise = new EnterpriseVO;
        $enterprisesArray = array();

        $sql = "SELECT * FROM `enterprise`";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 enterprises not exists!');
            echo json_encode(["error" => true, "msg" => "Enterprises not exists!"]);
            die();
        }

        while ($enterprises = mysqli_fetch_array($query, true)) {
            $enterprise->setId_enterprise($enterprises['id_enterprise']);
            $enterprise->setCorporate_name($enterprises['corporate_name']);
            $enterprise->setFantasy_name($enterprises['fantasy_name']);
            $enterprise->setNumbering_company($enterprises['numbering_company']);
            $enterprise->getNumbering_personal($enterprises['numbering_personal']);
            $enterprise->setDescription($enterprises['description']);
            $enterprise->setEnterprise_type($enterprises['enterprise_type']);

            $enterprisesArray[] = clone $enterprise;
        }

        return $enterprisesArray;
    }

    /**
     * Não deleta, mas só desativa a empresa.
     */
    public static function disableCompany($id, $conn)
    {
        $sql = "UPDATE `enterprise` SET `active`= 0  WHERE `id_enterprise` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `user` SET `businessman`= 0  WHERE `id_enterprise` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }

    /**
     * Não deleta, mas só desativa a empresa.
     */
    public static function reactivateCompany($id, $conn)
    {
        $sql = "UPDATE `enterprise` SET `active`= 1  WHERE `id_enterprise` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `user` SET `businessman`= 1  WHERE `id_enterprise` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }
}
