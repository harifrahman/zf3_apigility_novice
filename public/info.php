<?php
    // phpinfo();
    $serverName = "LAPTOP-LR7H9DSN\\XTEND";
    $serverName = "localhost";
    $connectionOptions = array(
        "Database" => "tirtanadi",
        "Uid" => "sa",
        "PWD" => "12345678"
    );
    try {
        //Establishes the connection
        $conn = new PDO('sqlsrv:Server=LAPTOP-LR7H9DSN\\XTEND,1433;Database=tirtanadi', 'sa', '12345678');
        echo 'success!';
        // $conn = sqlsrv_connect($serverName, $connectionOptions);
    } catch (\Exception $e) {
        //throw $th;
        echo $e->getMessage();
    }
    // if($conn) {
    //     echo "Connected..!";
    // } else {
    //     echo "Ggal euy";
    // }
?>