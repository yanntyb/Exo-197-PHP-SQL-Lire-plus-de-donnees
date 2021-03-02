<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php

class DbStatic{

    private static ?PDO $dbInsance = null;

    private string $server = "localhost";
    private string $dbname = "exo197";
    private string $user = "root";
    private string $password = "";

    public function __construct() {
        try{
            self::$dbInsance = new PDO("mysql:host=$this->server;database=$this->dbname;charset=utf8", $this->user, $this->password);
            self::$dbInsance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInsance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception){
            echo $exception->getMessage();
        }

    }

    public static function getInstance(): ?PDO {
        if(is_null(self::$dbInsance)){
            new self();
        }
        return self::$dbInsance;
    }


    /**
     * On empeche les gens de cloner l'objet
     * pour sassurer quon a bien quune seul instance de la connexion a la db
     */
    public function __clone() {}
}

    $db = DbStatic::getInstance();
    $req = "SELECT *  from exo197.clients";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>Clients : </h1><?php
        foreach($data as $item => $value){
                echo "<span>" . $value["lastName"] . " " . $value["firstName"] . "<br> Naissance : " . $value["birthDate"] . "<br>";
                if($value["card"] === "1"){
                    echo "Carte de fidelité Oui </span><br>";
                    echo "Numero : " . $value["cardNumber"];
                }
                else {
                    echo "Carte de fidelité Non </span>";
                }
                echo "<br><br><br>";
        }?>
    </div><?php

    $req = "SELECT *  from exo197.genres";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>Type de spectacles : </h1><?php
        foreach($data as $item => $value){
            echo "<span>" . $value["genre"] . "</span><br>";
        }?>
    </div>

    <?php
    $req = "SELECT *  from exo197.clients limit 20";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>20 premiers clients : </h1><?php
        foreach($data as $item => $value){
            echo "<span>" . $value["lastName"] . " " . $value["firstName"] . "</span><br>";
        }?>
    </div>

    <?php
    $req = "SELECT *  from exo197.clients where card = 1";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>Clients ayant une carte : </h1><?php
        foreach($data as $item => $value){
            echo "<span>" . $value["lastName"] . " " . $value["firstName"] . "</span><br>";
        }?>
    </div>

    <?php
    $req = "SELECT *  from exo197.clients where lastName like 'M%' order by lastname  ASC ";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>Clients dont le nom commence par la lettre M: </h1><?php
        foreach($data as $item => $value){
            echo "<span>" . $value["lastName"] . " " . $value["firstName"] . "</span><br>";
        }?>
    </div>

    <?php
    $req = "SELECT *  from exo197.shows order by title ASC ";
    $info = $db->prepare($req);
    $info->execute();
    $data = $info->fetchAll();?>
    <div id="info">
        <h1>Spectacle : </h1><?php
        foreach($data as $item => $value){
            echo "<span>" . $value["title"] . " par " . $value["performer"] . ", le " . $value["date"], " à " . $value["startTime"] . "</span><br>";
        }?>
    </div>
</body>
</html>
