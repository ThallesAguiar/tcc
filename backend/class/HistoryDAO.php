<?php

class HistoryDAO{
     /**
     * Salva historia .
     */
    public static function saveHistory(HistoryVO $historyVO, $conn)
    {
        $sql = "INSERT INTO `history`(`id_user`,`description` ) 
        VALUES ('" . $historyVO->getId_user() . "','" . $historyVO->getDescription() . "')";

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        return true;
    }

     /**
     * Busca todos as historias no Banco de dados.
     */
    public static function getAllHistories($conn)
    {
        $historiesArray = array();

        $sql = "SELECT `id_history`,`id_user`, `description` FROM `history`";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 histories not exists!');
            echo json_encode(["success" => true, "msg" => "Histories not exists!"]);
            die();
        }

        while ($histories = mysqli_fetch_array($query, true)) {

            $historiesArray[] = $histories;
        }

        return $historiesArray;
    }

    /**
     * Busca uma historia por ID history no Banco de dados.
     */
    public static function getHistoryByIdUser($id_user, $conn)
    {
        $sql = "SELECT `id_history`, `description` FROM `history` WHERE id_user = $id_user";
        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        return mysqli_fetch_assoc($query);
    }

    /**
     * Atualiza uma historia por IDhistory no Banco de dados.
     */
    public static function updateHistoryByIdUser(historyVO $history, $conn)
    {
        $sql = "UPDATE `history` SET `description`='" . $history->getDescription() . "' WHERE `id_user` = " . $history->getId_user() . "";
        // var_dump($sql);die();
        
        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }
        return mysqli_query($conn, $sql);
    }
}