<?php

include_once 'model.php';
include_once 'controller.php';
include_once 'view.php';

$action = $_POST['action'];

if ($action == 'ingresarContacto') {
    $resp = ModelContactos::ingresarContacto($_POST);
    if ($resp['success']) {
        $res = array('code' => '200', 'message' => 'Contacto agregado exitosamente.');
    } else {
        $res = array('code' => '501', 'message' => 'Error al agregar contacto.');
    }

    $result = json_encode($res);
}

if ($action == 'eliminarContacto') {
    $resp = ModelContactos::eliminar_contacto($_POST['contacto_id']);
    if ($resp) {
        $res = array('code' => '200', 'message' => 'Contacto eliminado exitosamente.');
    } else {
        $res = array('code' => '501', 'message' => 'Error al eliminar el contacto.');
    }

    $result = json_encode($res);
}

if ($action == 'filtrarContactos') {
    $resp = viewContactos::Contactos($_POST);
    if ($resp) {
        $res = array('code' => '200', 'message' => 'Contacto filtrado exitosamente.', 'html' => $resp);
    } else {
        $res = array('code' => '501', 'message' => 'Error al filtrar los contactos.');
    }

    $result = json_encode($res);
}

echo $result;
