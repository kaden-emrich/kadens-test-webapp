<?php

define('DB_SERVER', 'https://mysql.cvcc-bpa.com');
define('DB_USERNAME', 'cvccsqladmin');
define('DB_PASSWORD', 'Cvcc$ql@dmin');
define('DB_NAME', 'cvccmysqldb');

$db_link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($db_link === false) {
    echo "Something went wrong. Please try again.";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>