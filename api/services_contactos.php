<?php

// Configuración
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'contactos';
$charset = 'utf8mb4';

$token_secreto = 'a-string-secret-at-least-256-bits-long';

// Conexión DB
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al conectar con la base de datos']);
    exit;
}

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Validar token
$headers = getallheaders();
$jwt = $headers['Authorization'] ?? $headers['authorization'] ?? '';

if (empty($jwt)) {
    http_response_code(401);
    echo json_encode(['error' => 'Token no proporcionado']);
    exit;
}

// Eliminar prefijo "Bearer " si existe
if (stripos($jwt, 'Bearer ') === 0) {
    $jwt = trim(substr($jwt, 7));
}

/*if (!validar_token($jwt, $token_secreto)) {
    http_response_code(401);
    echo json_encode(['error' => 'Token inválido']);
    exit;
}*/

// Leer datos
$data = json_decode(file_get_contents("php://input"), true);
$accion = $_GET['accion'] ?? '';


// Ejecutar acción
switch ($accion) {
    case 'guardar':
        guardar_contacto($data, $conn);
        break;
    case 'consultar':
        consultar_contactos($data, $conn);
        break;
    case 'eliminar':
        eliminar_contacto($data, $conn);
        break;
<<<<<<< HEAD
=======
    case 'editard':
        editar_contacto($data, $conn);
>>>>>>> 5218a59 (Cuarto commit)
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}

// Funciones

function guardar_contacto($data, $conn)
{
    $nombre = $conn->real_escape_string($data['contacto_nombre'] ?? '');
    $correo = $conn->real_escape_string($data['contacto_correo'] ?? '');
    $telefono = $conn->real_escape_string($data['contacto_telefono'] ?? '');

    if (!$nombre) {
        echo json_encode(['error' => 'Nombre es obligatorio']);
        return;
    }

    if (!$correo) {
        echo json_encode(['error' => 'correo es obligatorio']);
        return;
    }

    if (!$telefono) {
        echo json_encode(['error' => 'Telefono es obligatorio']);
        return;
    }

    $sql = "INSERT INTO contactos (contacto_nombre, contacto_correo, contacto_telefono) VALUES ('$nombre', '$correo', '$telefono')";

    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'id_insertado' => $conn->insert_id]);
    } else {
        echo json_encode(['error' => $conn->error]);
    }
}

function consultar_contactos($data, $conn)
{
    $conditions = '';

    if ($data != '') {
        $contacto_nombre = $data['contacto_nombre'];
        $contacto_telefono = $data['contacto_telefono'];
        if ($contacto_nombre != '') {
            $conditions .= "AND contacto_nombre LIKE '%$contacto_nombre%'";
        }
        if ($contacto_telefono != '') {
            $conditions .= "AND contacto_telefono LIKE '%$contacto_telefono%'";
        }
    }

    $sql = "SELECT * FROM contactos WHERE 1 = 1 $conditions";
    $result = $conn->query($sql);

    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }

    echo json_encode(['contactos' => $datos]);
}

function eliminar_contacto($data, $conn)
{
    $id = intval($data['contacto_id'] ?? 0);
    if ($id <= 0) {
        echo json_encode(['error' => 'ID inválido']);
        return;
    }

    $sql = "DELETE FROM contactos WHERE contacto_id = $id";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $conn->error]);
    }
}

<<<<<<< HEAD
=======
function editar_contacto($data, $conn)
{
    $id = intval($data['contacto_id'] ?? 0);
    if ($id <= 0) {
        echo json_encode(['error' => 'ID inválido']);
        return;
    }

    $sql = "UPDATE contactos SET contacto_nombre='$contacto_nombre', contacto_correo='$contacto_correo', contacto_telefono='$contacto_telefono' WHERE contacto_id = '$id_contacto'";
    echo $sql;die;
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => $conn->error]);
    }
}

>>>>>>> 5218a59 (Cuarto commit)
function validar_token($jwt, $clave)
{
    $partes = explode('.', $jwt);
    if (count($partes) !== 3) return false;

    list($header, $payload, $firma) = $partes;

    // Calcular firma esperada
    $valida = hash_hmac('sha256', "$header.$payload", $clave, true);
    $valida_b64 = rtrim(strtr(base64_encode($valida), '+/', '-_'), '=');

    return hash_equals($firma, $valida_b64);
}
