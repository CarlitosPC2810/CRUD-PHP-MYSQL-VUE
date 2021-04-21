<?php 
require_once "../models/userModel.php";
$data = json_decode(file_get_contents('php://input'), true);

$tipoPeticion = $data['tipoPeticion'];

if($tipoPeticion == "listUsers"){
    echo json_encode(userModel::listarUsuarios());
}else if($tipoPeticion == "addUser"){
    echo json_encode(userModel::addUser($data['nombreUsuario'], $data['sexoUsuario'], $data['edadUsuario']));
}else if($tipoPeticion == "deleteUser"){
    echo json_encode(userModel::deleteUser($data['idUsuario']));
}else if($tipoPeticion == "updateUser"){
    echo json_encode(userModel::updateUser($data['idUsuario'], $data['nombreUsuario'], $data['sexoUsuario'], $data['edadUsuario']));
}

?>