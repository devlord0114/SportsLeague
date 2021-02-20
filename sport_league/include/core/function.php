<?php //error_reporting(0);
 
#User Login
function login($username, $password) {
    global $mysql;
    $sql = "SELECT id FROM users where email = '".$username."' and password = '".$password."'";
    $result = mysqli_query($mysql, $sql);
    $num_rows = mysqli_num_rows($result);
     
    if ($num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {
        return false;
    }
}

# Insert Data 
function Insert($table, $data) {
    global $mysql;
    $fields = array_keys($data);
    $values = array_map(array($mysql, 'real_escape_string'), array_values($data));
    mysqli_query($mysql, "INSERT INTO $table(".implode(",", $fields).") VALUES ('".implode("','", $values )."');") or die(mysqli_error($mysql));
}

// Update Data, Where clause is left optional
function Update($table_name, $form_data, $where_clause='') {
    global $mysql;
    // check for optional where clause
    $whereSQL = '';
    if (!empty($where_clause)) {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach ($form_data as $column => $value) {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
         
    // run and return the query result
    return mysqli_query($mysql, $sql);
}

 
//Delete Data, the where clause is left optional incase the user wants to delete every row!
function Delete($table_name, $where_clause='') {
    global $mysql;
    // check for optional where clause
    $whereSQL = '';
    if (!empty($where_clause)) {
        // check to see if the 'where' keyword exists
        if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
     
    // run and return the query result resource
    return mysqli_query($mysql, $sql);
}

//Image compress
function compress_image($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source_url);
    } else if ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source_url);
    } else if ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source_url);
    }

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

?>