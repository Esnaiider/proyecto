<?php
function conexion(){
$host = 'localhost';
$db   = 'contactos';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
return $pdo;

}

 function insert($query, $params) {
    try {
        $pdo = conexion();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $pdo->lastInsertId(); // devuelve el ID insertado
    } catch (PDOException $e) {
        return "Error en insert: " . $e->getMessage();
    }
}

function select($query, $params = []) {
    try {
        $pdo = conexion();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(); // array de resultados
    } catch (PDOException $e) {
        return "Error en select: " . $e->getMessage();
    }
}

<<<<<<< HEAD
=======
function update($query, $params) {
    try {
        $pdo = conexion();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount(); // número de filas eliminadas
    } catch (PDOException $e) {
        return "Error en delete: " . $e->getMessage();
    }
}

>>>>>>> 5218a59 (Cuarto commit)
function delete($query, $params) {
    try {
        $pdo = conexion();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount(); // número de filas eliminadas
    } catch (PDOException $e) {
        return "Error en delete: " . $e->getMessage();
    }
}




?>