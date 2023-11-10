<!-- Atteindre le serveur car_auction -->
<?php
class Serveur {
    private $dbh;

    public function __construct() {
        $dbh = new PDO("mysql:dbname=car_auction;host=localhost;port=8889", "root", "root");
    }
}

?>