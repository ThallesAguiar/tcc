<?php

class SearchDAO
{
    /**
     * procura todos os usuarios proximos com maximo de alcance $range, em milhas ou kilometros.
     */
    public static function calculateDistance($id_user, $lat, $lng, $range, $unit = 'kilometres', $conn)
    {
        if ($unit == 'kilometres') {
            $dist = 6371;
        } else if ($unit == 'miles') {
            $dist = 3959;
        }

        $sql = "SELECT 
        concat(u.name, ' ', u.lastname) as nameComplete,
        u.avatar, 
        u.businessman, 
        u.id_enterprise, 
        u.id_user,
        u.lng,  
        u.lat,  
        ($dist * ACOS(COS(RADIANS($lat)) * COS(RADIANS(Y(coordinates))) 
        * COS(RADIANS(ST_X(coordinates)) - RADIANS($lng)) + SIN(RADIANS($lat))
        * SIN(RADIANS(ST_Y(coordinates))))) AS distance
    FROM user u
    WHERE MBRContains
        (
        LineString
            (
            Point (
                $lng + $range / (111.320 * COS(RADIANS($lat))),
                $lat + $range / 111.133
            ),
            Point (
                $lng - $range / (111.320 * COS(RADIANS($lat))),
                $lat - $range / 111.133
            )
        ),
        coordinates
        )
        AND id_user != $id_user
        AND `status` = 'ATIVO'
    HAVING distance < $range
    ORDER By distance";

        $query = mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            header('HTTP/1.1 400 error in DB');
            ob_clean();
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        if (mysqli_num_rows($query) <= 0) {
            header('HTTP/1.1 400 users not exists near to you!');
            echo json_encode(["error" => true, "msg" => "Users not exists near to you!"]);
            die();
        }

        while ($users = mysqli_fetch_array($query, true)) {

            $usersArray[] = $users;
        }

        return $usersArray;
    }
}






// SELECT *, (6371 * ACOS(COS(RADIANS(-27.066368)) * COS(RADIANS(Y(coordinates))) * COS(RADIANS(ST_X(coordinates)) - RADIANS(-48.889854)) + SIN(RADIANS(-27.066368)) * SIN(RADIANS(ST_Y(coordinates))))) AS distance FROM user WHERE MBRContains ( LineString ( Point ( -48.889854 + 15 / (111.320 * COS(RADIANS(-27.066368))), -27.066368 + 15 / 111.133 ), Point ( -48.889854 - 15 / (111.320 * COS(RADIANS(-27.066368))), -27.066368 - 15 / 111.133 ) ), coordinates ) HAVING distance < 15 ORDER By distance