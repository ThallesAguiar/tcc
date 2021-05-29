<?php

class EnterpriseDAO
{
    /**
     * Salvar empresa no Banco de dados.
     */
    public function saveEnterprise(EnterpriseVO $enterpriseVO, $id_user, $conn)
    {
        $sql = "INSERT INTO `empresa`(`razao_social`, `nome_empresa`, `numero_PJ`, `numero_PF`, `descricao`,`tipo_empreendimento`) 
        VALUES ('" . $enterpriseVO->getCompany_name() . "','" . $enterpriseVO->getFantasy_name() . "','" . $enterpriseVO->getNumber_pj() . "','" . $enterpriseVO->getNumber_pf() . "','" . $enterpriseVO->getDescription() . "','" . $enterpriseVO->getType_company() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        /**pega o id da empresa criada e salva no usuario que criou */
        $enterpriseVO->setId_enterprise(mysqli_insert_id($conn));

        $sql = "UPDATE `usuario` SET `empresario`= 1,`id_empresa`='" . $enterpriseVO->getId_enterprise() . "' WHERE `id_usuario` = " . $id_user  . "";
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
        $sql = "UPDATE `empresa` SET `razao_social`='" . $enterpriseVO->getCompany_name() . "',`nome_empresa`='" . $enterpriseVO->getFantasy_name() . "',`numero_PJ`='" . $enterpriseVO->getNumber_pj() . "',`numero_PF`='" . $enterpriseVO->getNumber_pf() . "',`descricao`='" . $enterpriseVO->getDescription() . "',`tipo_empreendimento`='" . $enterpriseVO->getType_company() . "' WHERE `id_empresa` = " . $enterpriseVO->getId_enterprise() . "";
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
        $sql = "SELECT * FROM `empresa` WHERE id_empresa = $id";
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
     * Busca todos os usuário no Banco de dados.
     */
    public static function getAllEnterprises($conn)
    {
        $enterprise = new EnterpriseVO;
        $enterprisesArray = array();

        $sql = "SELECT * FROM `empresa`";
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
            $enterprise->setId_enterprise($enterprises['id_empresa']);
            $enterprise->setCompany_name($enterprises['razao_social']);
            $enterprise->setFantasy_name($enterprises['nome_empresa']);
            $enterprise->setNumber_pj($enterprises['numero_PJ']);
            $enterprise->setNumber_pf($enterprises['numero_PF']);
            $enterprise->setDescription($enterprises['descricao']);
            $enterprise->setType_company($enterprises['tipo_empreendimento']);

            $enterprisesArray[] = clone $enterprise;
        }

        return $enterprisesArray;
    }

    /**
     * Não deleta, mas só desativa a empresa.
     */
    public static function disableCompany($id, $conn)
    {
        $sql = "UPDATE `empresa` SET `ativo`= 0  WHERE `id_empresa` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `usuario` SET `empresario`= 0  WHERE `id_empresa` = " . $id . "";
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
        $sql = "UPDATE `empresa` SET `ativo`= 1  WHERE `id_empresa` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        $sql = "UPDATE `usuario` SET `empresario`= 1  WHERE `id_empresa` = " . $id . "";
        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
    }
}
