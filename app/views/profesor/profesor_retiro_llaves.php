<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_retiro_llaves.css">
    <title>SALI · Retiro de Llaves</title>
</head>

<body>


    <?php
    $this_location = 'profesor_retiro';

    require 'includes/activate_geo.php';

    include 'includes/geo_help.php';
    require 'includes/header.php';


    require 'includes/back_to_main.php'
    ?>


    <main id="main_content" class="px-3 pb-5 col-lg-8 col-12 mx-auto d-flex flex-column" style="min-height: calc(100vh - 135px);">
        <div id="main_content_loader" class="mx-auto mt-5 spinner-grow text-secondary" style="height:65px; width: 65px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        
        
        <section id="ret_keys_container" class="d-none mt-4">
            <div id="ok_keys" class="d-none">
                <h3 style="color: #143e63;" class="fw-semibold mb-1">Llaves para retirar</h3>
                <p>Seleccione las llaves asignadas para el día de hoy, según horario, que desea retirar:</p>
                
                <div id="keys_list" class="d-flex row row-cols-1 row-cols-md-2 px-2 mb-5">
                </div>
            </div>
            
            
            
            
        
        </section>
        
        
    </main>
    
    <div id="verify_ret_cont" class="d-none position-fixed bottom-0 mb-4 col-12 ">
        <button id="verify_ret_cont_btn" type="button" class="d-flex align-items-center justify-content-center mx-auto btn btn-primary col-11 gap-2" data-bs-toggle="modal" data-bs-target="#verify_code_modal"> 
            <span class="fw-semibold">Verificar retiro</span>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-password-mobile-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17v4" /><path d="M10 20l4 -2" /><path d="M10 18l4 2" /><path d="M5 17v4" /><path d="M3 20l4 -2" /><path d="M3 18l4 2" /><path d="M19 17v4" /><path d="M17 20l4 -2" /><path d="M17 18l4 2" /><path d="M7 14v-8a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v8" /><path d="M11 5h2" /><path d="M12 17v.01" /></svg>
        </button>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="verify_code_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Código de retiro</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div id="verify_code_modal_body" class="modal-body">
            
            <p id="no_keys_msg">Debe seleccionar <strong>al menos una llave</strong> para poder proceder con el retiro de llaves.</p>
            
            <p id="select_tabl_text" class="d-none">Elija el código mostrado en la <b>tablet de Coordinación</b>:
             <br>
             <span class="text-secondary">
                  ¿Códigos incorrectos?
                  <a id="renew_codes" class="text-primary text-decoration-underline" style="margin-left: 2px; cursor:pointer;">Renovar los códigos</a>
            </span>
             </p>
            
            <p id="fails_max" class="d-none">Máximo de intento excedido, visualize el <strong>código de la tablet en la Oficina de Coordinación</strong> e inténtelo de nuevo</p>
            
            <div id="codes_for_retire" class="d-none">
                <div id="code_1" class="ch_code d-flex justify-content-center align-items-center border rounded fw-bold my-2 shadow-sm" style="color: #143e63; padding-top: 1.9rem !important; font-size: 1.3rem !important;
    padding-bottom: 1.9rem !important;" data-cod="">
                    <div class="spinner-border text-secondary border-2" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                </div>
                <div id="code_2" class="ch_code d-flex justify-content-center align-items-center border rounded fw-bold my-2 shadow-sm" style="color: #143e63; padding-top: 1.9rem !important; font-size: 1.3rem !important;
    padding-bottom: 1.9rem !important;" data-cod="">
                    <div class="spinner-border text-secondary border-2" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                </div>
                <div id="code_3" class="ch_code d-flex justify-content-center align-items-center border rounded fw-bold my-2 shadow-sm" style="color: #143e63; padding-top: 1.9rem !important; font-size: 1.3rem !important;
    padding-bottom: 1.9rem !important;" data-cod="">
                    <div class="spinner-border text-secondary border-2" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                </div>
                <div id="code_4" class="ch_code d-flex justify-content-center align-items-center border rounded fw-bold my-2 shadow-sm" style="color: #143e63; padding-top: 1.9rem !important; font-size: 1.3rem !important;
    padding-bottom: 1.9rem !important;" data-cod="">
                    <div class="spinner-border text-secondary border-2" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
                </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button id="back_rkeys" type="button" class="w-100 btn btn-secondary fw-semibold" data-bs-dismiss="modal">Volver</button>
          </div>
        </div>
      </div>
    </div>
    
    
    
    <div class="modal fade" id="process_retiro_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-dialog-centered">
                    <h1 class="modal-title fs-5 fw-bold" id="no_key_modal_label">Retiro de llaves procesado</h1>
                </div>
                <div class="modal-body">
                    <p id="process_retiro_msg" class="mb-0"></p>
                </div>
                <div class="modal-footer">
                    <a href="profesor" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!--SIN ESPECIALIDADES-->
    <div class="modal fade" id="no_sch_modal" tabindex="-1" aria-labelledby="no_sch_modal_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5 fw-bold" id="reqkey_infolabel"> Horario sin asignar</h1>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Lo sentimos, actualmente no tiene ningún horario asignado en el sistema, por lo cual no hay llaves por retirar. Si necesita más información, por favor consulte con el equipo de Coordinación. De lo contrario, le invitamos a verificar nuevamente en otro momento.</p>
                </div>
                <div class="modal-footer">
                    <a href="profesor" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                </div>
            </div>
        </div>
    </div>

    <!--SI NO HAY LLAVES EN EL HORARIO-->
    <div class="modal fade" id="no_keys_modal" tabindex="-1" aria-labelledby="no_key_modal_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-dialog-centered">
                    <h1 class="modal-title fs-5 fw-bold" id="no_key_modal_label">Sin llaves por retirar</h1>
                </div>
                <div class="modal-body">
                    <p class="mb-0">No hay llaves por retirar, si considera que esto es un error, consulte su horario o comuníquese con el equipo de Coordinación.</p>
                </div>
                <div class="modal-footer">
                    <a href="profesor" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="no_near_coordinacion" tabindex="-1" aria-labelledby="no_near_coordinacion_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="no_near_coordinacion_label">Lejos del punto de retiro</h1>
                </div>
                <div class="modal-body">
                <p class="mb-0">Se encuentra a <strong id="no_near_mts"></strong> metros de distancia de la oficina de Coordinación. Por favor, acérquese a esta locación para proceder con este trámite.</p>
                </div>
                <div class="d-flex gap-2 justify-content-center align-items-center p-3 border-top">
                    <a href="profesor" type="button" class="fw-bold btn w-50 btn-secondary">Volver a Inicio</a>
                    <a href="profesor_retiro" type="button" class="fw-bold btn w-50 btn-primary">Ingresar de nuevo</a>
                </div>
            </div>
        </div>
    </div>


    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/profesor/profesor_ret_llaves.js"></script>
    <!--<script src="./public/js/profesor/profesor_geo_llave.js"></script>-->


</body>

</html>