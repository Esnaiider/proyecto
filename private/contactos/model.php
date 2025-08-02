<?php
date_default_timezone_set('America/Bogota');
include dirname(__FILE__) . '/../general/services.php';
class ModelContactos
{
    public static function ingresarContacto($params)
    {
        $contacto_nombre = $params['contacto_nombre'];
        $contacto_correo = $params['contacto_correo'];
        $contacto_telefono = $params['contacto_telefono'];

        $body = array(
            'contacto_nombre' => $contacto_nombre,
            'contacto_correo' => $contacto_correo,
            'contacto_telefono' => $contacto_telefono,
        );

        $_service = new ServicesAPI();

        $resp = $_service->services_guardar_contacto($body);

        return $resp;
    }

    public static function listar_contactos($params = '')
    {

        if ($params != '') {
            $contacto_nombre = $params['contacto_nombre'];
            $contacto_telefono = $params['contacto_telefono'];
        } else {
            $contacto_nombre = '';
            $contacto_telefono = '';
        }

        $body = array(
            'contacto_nombre' => $contacto_nombre,
            'contacto_telefono' => $contacto_telefono,
        );

        $_service = new ServicesAPI();

        $resp = $_service->services_consultar_contacto($body);

        return $resp;
    }

    public static function eliminar_contacto($id_contacto)
    {
        $_service = new ServicesAPI();

        $body = array('contacto_id' => $id_contacto);

        $resp = $_service->services_eliminar_contacto($body);

        return $resp;
    }
<<<<<<< HEAD
=======

    public static function editar_contacto($contacto_nombre){

        $_service = new ServicesAPI();

        $body = array('contacto_nombre' => $contacto_nombre);
        $resp = $_service->services_editar_contacto($body);

        return $resp;
    }
>>>>>>> 5218a59 (Cuarto commit)
}
