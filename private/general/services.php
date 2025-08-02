<?php
class ServicesAPI
{
    private $server_url_guardar_datos_contacto;
    private $server_url_consultar_datos_contacto;
    private $server_url_eliminar_datos_contacto;
    private $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImlhdCI6MTUxNjIzOTAyMn0.KMUFsIDTnFmyG3nMiGM6H9FNFUROf3wh7SmqJp-QV30';

    public function __construct()
    {
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
<<<<<<< HEAD
            $url_server = 'http://localhost/proyecto_contactos/api/';
=======
            $url_server = 'http://localhost/proyecto-main/api/';
>>>>>>> 0ef8092 (Tercer commit)
        } else {
            $url_server = 'https://www.dominio.com/api/';
        }

        $this->server_url_guardar_datos_contacto = $url_server . 'guardarDatosContacto';
        $this->server_url_consultar_datos_contacto = $url_server . 'consultarDatosContacto';
        $this->server_url_eliminar_datos_contacto = $url_server . 'eliminarDatosContacto';
    }

    public function services_guardar_contacto($params)
    {
        $url = $this->server_url_guardar_datos_contacto;

        $authorization = 'Bearer ' . $this->token;

        return $this->ejecutarApi($url, $params, $authorization);
    }

    public function services_consultar_contacto($params)
    {
        $url = $this->server_url_consultar_datos_contacto;

        $authorization = 'Bearer ' . $this->token;

        return $this->ejecutarApi($url, $params, $authorization);
    }

    public function services_eliminar_contacto($params)
    {
        $url = $this->server_url_eliminar_datos_contacto;

        $authorization = 'Bearer ' . $this->token;

        return $this->ejecutarApi($url, $params, $authorization);
    }


    public function ejecutarApi($url, $body, $authorization = "")
    {
        $data = json_encode($body);
        $headers = ['Content-Type: application/json'];

        if (!empty(trim($authorization))) {
            $headers[] = 'Authorization: ' . $authorization;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return [
                'success' => false,
                'error' => $error,
                'http_code' => $httpCode,
            ];
        }

        curl_close($curl);
        $decoded = json_decode($response, true);

        return [
            'success' => true,
            'http_code' => $httpCode,
            'data' => $decoded,
        ];
    }
}
