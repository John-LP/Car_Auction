<!-- Atteindre le serveur car_auction -->
<?php
class Serveur {
    private $dbh;

    public function __construct() {
        $this->dbh = new PDO("mysql:dbname=car_auction;host=localhost", "root", "");
    }
}

?>