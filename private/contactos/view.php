<?php
include_once 'model.php';
date_default_timezone_set('America/Bogota');

class viewContactos
{

    public static function form_ingreso()
    {

        $fecha_actual = date('Y-m-d');

        $html = <<<HTML
        <div class="mb-3 col-lg-6 col-12 p-4 mx-auto" style="border: 2px solid #1A2035; border-radius: 10px;">
            <div class="col-lg-12 px-2">
                <h2><b style="font-size:17px;font-weight:bold; color:#1A2035;">FORMULARIO DE REGISTRO</b></h2>
                <hr>
            </div>
            <form>
                <div class="row">
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="contacto_nombre" class="form-label" style="font-weight:bold; color:#1A2035;">Nombre</label>
                        <input type="text" class="form-control" id="contacto_nombre" placeholder="Ingrese nombre contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="contacto_correo" class="form-label" style="font-weight:bold; color:#1A2035;">Correo electronico:</label>
                        <input type="email" class="form-control" id="contacto_correo" placeholder="Ingrese correo contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                    </div>
                    <div class="mb-3 col-lg-6 col-12">
                        <label for="contacto_telefono" class="form-label" style="font-weight:bold; color:#1A2035;">Telefono:</label>
                        <input type="number" class="form-control" id="contacto_telefono" placeholder="Ingrese telefono contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                    </div>
                    <div class="mb-3 col-lg-12 col-12 d-flex justify-content-center">
                        <input type="button" class="ingresarContacto col-lg-6 mt-4 btn mx-auto" style="background:#1A2035; color:white; font-weight:bold;" value="INGRESAR CONTACTO"/>
                  </div>
                </div>
            </form>
        </div>
HTML;

        return $html;
    }


    public static function Contactos($params = '')
    {

        $contactos = ModelContactos::listar_contactos($params)['data']['contactos'];

        if (is_array($contactos) && count($contactos) > 0) {
            $tbody = "";
            foreach ($contactos as $key => $value) {
                $contacto_id = $value['contacto_id'];
                $contacto_nombre = $value['contacto_nombre'];
                $contacto_correo = $value['contacto_correo'];
                $contacto_telefono = $value['contacto_telefono'];

                $tbody .= <<<HTML
                 <tr>
                <th scope="row">$contacto_id</th>
                <td>$contacto_nombre</td>
                <td>$contacto_correo</td>
                <td>$contacto_telefono</td>

                <td class="text-center"><a class="eliminar_contacto" atr_id_$contacto_id="$contacto_id" style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg></a></td>
<<<<<<< HEAD
=======
                <td class="text-center"><button class="btn mb-3 py-auto" style="background:#1A2035; color:white; font-weight:bold;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                    </svg>
                    Editar
                </button></td>
>>>>>>> 5218a59 (Cuarto commit)
            </tr>
HTML;
            }
        } else {
            $tbody = <<<HTML
            <tr>
                <td colspan = '8' class="text-center">No se encontraron resultados</td>
            </tr>    
HTML;
        }

        $html = <<<HTML
        
        <div class="table-responsive">
            <div class="" style="float: right;">
                <button class="btn mb-3 py-auto" style="background:#1A2035; color:white; font-weight:bold;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                    </svg>
                    Filtrar
                </button>
            </div>
        <table class="table table-bordered">
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Eliminar</th>
<<<<<<< HEAD
=======
                <th scope="col">Editar</th>
>>>>>>> 5218a59 (Cuarto commit)
            </tr>
            </thead>
            <tbody>
            $tbody
            </tbody>
        </table>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
<<<<<<< HEAD
=======
                    <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 col-lg-12 col-12 p-4 mx-auto" style="">
                        <form>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-12">
                                    <label for="contacto_nombre" class="form-label" style="font-weight:bold; color:#1A2035;">Nombre</label>
                                    <input type="text" class="form-control" id="contacto_nombre" placeholder="Ingrese nombre contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                                </div>
                                <div class="mb-3 col-lg-6 col-12">
                                    <label for="contacto_correo" class="form-label" style="font-weight:bold; color:#1A2035;">Telefono:</label>
                                    <input type="text" class="form-control" id="contacto_correo" placeholder="Ingrese correo contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                                </div>
                                <div class="mb-3 col-lg-6 col-12">
                                    <label for="contacto_telefono" class="form-label" style="font-weight:bold; color:#1A2035;">Telefono:</label>
                                    <input type="number" class="form-control" id="contacto_telefono" placeholder="Ingrese telefono contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="editar_contacto" style="background:#1A2035; color:white;">Editar</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
>>>>>>> 5218a59 (Cuarto commit)
                    <h1 class="modal-title fs-5" id="exampleModalLabel">FILTROS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 col-lg-12 col-12 p-4 mx-auto" style="">
                        <form>
                            <div class="row">
                                <div class="mb-3 col-lg-6 col-12">
                                    <label for="contacto_nombre" class="form-label" style="font-weight:bold; color:#1A2035;">Nombre</label>
                                    <input type="text" class="form-control" id="contacto_nombre" placeholder="Ingrese nombre contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                                </div>
                                <div class="mb-3 col-lg-6 col-12">
                                    <label for="contacto_telefono" class="form-label" style="font-weight:bold; color:#1A2035;">Telefono:</label>
                                    <input type="number" class="form-control" id="contacto_telefono" placeholder="Ingrese telefono contacto" style="border: 2px solid #1A2035; color: #1A2035;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn" id="completar_filtro" style="background:#1A2035; color:white;">Filtrar</button>
                </div>
                </div>
            </div>
        </div>

HTML;

        return $html;
    }
}
