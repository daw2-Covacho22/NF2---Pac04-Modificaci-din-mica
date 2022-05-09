<?php
require("class.Dades.php");
require("class.pdofactory.php");

$strDSN = "pgsql:dbname=buscador;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "alex", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST["palabra"])){
    $textBusqueda = $_POST["palabra"];
    
    //fem la consulta
    $strQuery = "SELECT * FROM datos 
    WHERE paraula like '$textBusqueda%' ORDER BY total DESC LIMIT 5";
    $objStatement = $objPDO->prepare($strQuery);
    

    $objStatement->execute();
    //mirem si a la bd existeix aquesta paraula
    $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

    //en cas de que no existeixi ho guardem a la bd
    if(empty($arParaules)){
        $paraules = new Dades($objPDO);
        $paraules->setparaula($textBusqueda)->settotal(1)->setultimavisita(date("Y-m-d H:i:s"));
        $paraules->Save();

    }else{
        $strQuery = "SELECT * FROM datos 
        WHERE paraula = '$textBusqueda'";
        $objStatement = $objPDO->prepare($strQuery);
        $objStatement->execute();
        $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

        $jsondata = array();
        $arIds = array();

        foreach($arParaules as $value){
            $id = $value['id'];
            $total = $value['total'];
            $paraulaExisteix = new Dades($objPDO, $id);            
            $paraulaExisteix->settotal($total+1)->setultimavisita(date("Y-m-d H:i:s"));
            $paraulaExisteix->Save();
            $paraula = $value['paraula'];
            array_push($jsondata, $paraulaExisteix);
            array_push($arIds, $id);
        }
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata,JSON_FORCE_OBJECT);
    }
}

if(isset($_POST["submit"])){
    $textBusqueda = $_POST["submit"];

    $strQuery = "SELECT * FROM datos 
    WHERE paraula like '$textBusqueda%' ORDER BY total DESC LIMIT 5";
    $objStatement = $objPDO->prepare($strQuery);
    $objStatement->execute();
    $arParaules = $objStatement->fetchAll(PDO::FETCH_ASSOC);

    $jsondata = array();
    foreach($arParaules as $value){
        $id = $value['id'];
        $paraula = $value['paraula'];
        $total = $value['total'];
        $visita = $value['ultimavisita'];

        array_push($jsondata, $id, $paraula, $total, $visita);
    }
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata,JSON_FORCE_OBJECT);
}
?>
