<?php
class ControllerContactos{
    public static function validateInputs($params){

        $retorno = array(
            'res' => true,
            'mensaje' => 'Validación exitosa'
        );

        $contacto_telefono = $params['contacto_telefono'];
        $action = $params['action'];
        
        if ($action == 'ingresarContacto') {
            $sql = "SELECT contacto_telefono FROM contactos WHERE contacto_telefono = ?";
            $params_sql = [$contacto_telefono];
            $result = select($sql, $params_sql);    
            if (is_array($result) && count($result) > 0) {
                return [
                    'res' => false,
                    'mensaje' => "El telefono '$contacto_telefono' ya se encuentrá en sistema."
                ];
            }
        }

        if ($params['contacto_nombre'] == "") {
            return [
                'res' => false,
                'mensaje' => "El nombre del contacto debe ser ingresado."
            ];
        }

        if (!filter_var($params['contacto_correo'], FILTER_VALIDATE_EMAIL)) {
            return [
                'res' => false,
                'mensaje' => "El correo electrónico no es válido."
            ];
        }

        if (!is_numeric($params['contacto_telefono'])) {
            return [
                'res' => false,
                'mensaje' => "El teléfono debe ser numérico."
            ];
        }
        
        return $retorno;
    }
}



