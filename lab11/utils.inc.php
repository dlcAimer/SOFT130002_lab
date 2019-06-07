<?php
function startConn(){
    $servername = "localhost";
    $username = "root";
    $password = "Wgb980823@";
    $dbname = "travel";

// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    return $conn;
}

function getAllContinents(){
    $conn = startConn();
//    $continents = array();

    $sql = "SELECT ContinentCode, ContinentName FROM Continents";
    $result = $conn->query($sql);
//    if ($result->num_rows > 0) {
//        while ($row = $result->fetch_assoc()) {
//            $continents[$row["ContinentCode"]] = $row["ContinentName"];
//        }
//    }

    $conn->close();
    return $result;
}

function getAllCountries(){
    $conn = startConn();

    $sql = "SELECT ISO, CountryName FROM Countries";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

function getAllImages(){
    $conn = startConn();

    $sql = "SELECT ImageID, Title, Description, Path FROM ImageDetails";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

function findByContinentAndISO($ContinentCode, $ISO){
    $conn = startConn();

    $sql = "SELECT ImageID, Title, Description, Path FROM ImageDetails 
            WHERE ContinentCode = '$ContinentCode' AND CountryCodeISO = '$ISO'";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

function findByContinent($ContinentCode){
    $conn = startConn();

    $sql = "SELECT ImageID, Title, Description, Path FROM ImageDetails 
            WHERE ContinentCode = '$ContinentCode'";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

function findByISO($ISO){
    $conn = startConn();

    $sql = "SELECT ImageID, Title, Description, Path FROM ImageDetails 
            WHERE CountryCodeISO = '$ISO'";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

function getImages($ContinentCode, $ISO){
    if ($ContinentCode && $ISO) {
        $result = findByContinentAndISO($ContinentCode, $ISO);
    } elseif ((!$ContinentCode) && $ISO) {
        $result = findByISO($ISO);
    } elseif ($ContinentCode && (!$ISO)) {
        $result = findByContinent($ContinentCode);
    } else {
        $result = getAllImages();
    }
    return $result;
}