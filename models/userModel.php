<?php
require_once 'connectionModel.php';
class userModel
{
    public static function listarUsuarios()
    {
        try {
            $SQL =
                "SELECT *FROM usuarios";
            $stmt = Connection::connect()->prepare($SQL);
            if ($stmt->execute()) {
                return ["success", $stmt->fetchAll()];
            } else {
                return ["error", "Error imposible obtener registros !"];
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public static function addUser($nombreUsuario, $sexoUsuario, $edadUsuario)
    {
        try {
            $SQL =
                "INSERT INTO usuarios
                (
                    nombre,
                    sexo,
                    edad
                )
                VALUES
                (
                    '$nombreUsuario',
                    '$sexoUsuario',
                    '$edadUsuario'
                )";

            $stmt = Connection::connect()->prepare($SQL);
            if ($stmt->execute()) {
                return ["success", "Usuario registrado !"];
            } else {
                return ["error", "Imposible registrar usuario"];
            }
        } catch (\Exception $e) {
            return ["error", "Error SQL $e"];
        }
    }

    public static function deleteUser($idUsuario)
    {
        try {
            $SQL =
                "DELETE FROM usuarios WHERE id = $idUsuario";
            $stmt = Connection::connect()->prepare($SQL);
            if ($stmt->execute()) {
                return ["success", "Usuario eliminado !"];
            } else {
                return ["error", "Imposible eliminar usuario !"];
            }
        } catch (\Exception $e) {
            return ["error", "ERROR SQL $e"];
        }
    }

    public static function updateUser($idUsuario, $nombreUsuario, $sexoUsuario, $edadUsuario)
    {
        try {
            $SQL =
                "UPDATE usuarios 
                SET 
                    nombre = '" . $nombreUsuario . "', 
                    sexo = '" . $sexoUsuario . "', 
                    edad = '" . $edadUsuario . "'
                WHERE id = '" . $idUsuario . "'";
            $stmt = Connection::connect()->prepare($SQL);
            if ($stmt->execute()) {
                return ["success", "Usuario actualizado !"];
            } else {
                return ["error", "Imposible actualizar usuario !"];
            }
        } catch (\Exception $e) {
            return ["error", "ERROR SQL $e"];
        }
    }
}
