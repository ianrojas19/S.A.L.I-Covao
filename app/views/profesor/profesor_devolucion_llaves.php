<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_dev_llaves.css">
    <title>SALI · Devolución de Llaves</title>
</head>

<body>


    <?php
    $this_location = 'profesor_devolucion';

    require 'includes/activate_geo.php';

    include 'includes/geo_help.php';

    require 'includes/header.php';

    require 'includes/back_to_main.php'
    ?>
   
   <main id="main_content" class="px-3 pb-5 col-lg-8 col-12 mx-auto d-flex flex-column" style="min-height: calc(100vh - 135px);">
         
         <div id="main_content_loader" class="mx-auto mt-5 spinner-grow text-secondary" style="height:65px; width: 65px;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        
        <section id="dev_keys_container" class="d-none mt-4">
            <h3 style="color: #143e63;" class="fw-semibold mb-1">Llaves para devolver</h3>
            <p class="mb-1">Seleccione las llaves que desea devolver:</p>
            
            <div id="keys_list" class="d-flex row row-cols-1 row-cols-md-2 px-2 mb-5">
            
            </div>
        </section>
    </main>
    
    <div id="verify_dev_cont" class="d-none position-fixed bottom-0 mb-4 col-12">
        <button id="verify_dev_cont_btn" type="button" class="d-flex align-items-center justify-content-center mx-auto btn btn-primary col-11 gap-2" data-bs-toggle="modal" data-bs-target="#details_dev"> 
            <span class="fw-semibold">Dar detalles de devolución</span>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 17h6" /><path d="M9 13h6" /></svg>
        </button>
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="details_dev" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de devolución</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <p id="no_keys_msg" class="d-none">Debe seleccionar <strong>al menos una llave</strong> para poder proceder con la devolución de llaves.</p>
        
            <form id="form_dev_keys" class="d-none">
                  <div class="mb-3">
                    <label for="razon" class="form-label fw-semibold" style="color: #143e63">Razón de devolución</label>
                    <select id="razon" class="form-select" >
                      <option selected value="2">Fin de jornada laboral del día</option>
                      <option value="1">Fin de uso regular de llave por horario</option>
                      <option value="3">Motivos institucionales</option>
                      <option value="3">Ha ocurrido una emergencia</option>
                    </select>
                  </div>
                  
                  <div class="mb-3">
                    <label for="condicion" class="form-label fw-semibold" style="color: #143e63">Condición de devolución</label>
                    <select id="condicion" class="form-select shadow-none border-success">
                      <option selected value="1">Buena - Sin problemas</option>
                      <option value="2">Intermedia - Problemas menores</option>
                      <option value="3">Grave - Problemas mayores</option>
                    </select>
                    <div class="form-text">En condiciones graves, se le insta a ser ampliamente descriptivo en la <b>redacción de la bitácora</b>. </div>
                  </div>
                  
                  <div class="mb-3">
                    <label for="bitacora" class="form-label fw-semibold" style="color: #143e63">Bitácora</label>
                    <textarea class="form-control" id="bitacora" placeholder="Describa con el mayor detalle posible las circunstancias del uso o devolución de las llaves, incluyendo objetos, lugares, y personas involucradas, si corresponde." style="height: 350px"></textarea>
                    
                  </div>
            </form>
            
          </div>
          <div class="modal-footer">
            <button id="back_to_dev" type="button" class="w-100 btn btn-secondary fw-semibold" data-bs-dismiss="modal">Volver</button>
            <button id="process_dev_keys" type="button" class="d-none btn btn-primary fw-semibold">Devolver llaves</button>
          </div>
        </div>
      </div>
    </div>



      <div class="modal fade" id="process_devolucionres_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-dialog-centered">
                        <h1 class="modal-title fs-5 fw-bold" id="no_key_modal_label">Devolución de llaves procesada</h1>
                    </div>
                    <div class="modal-body">
                        <p id="process_dev_msg" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="profesor" type="button" class="btn w-100 btn-primary fw-bold">Entendido</a>
                    </div>
                </div>
            </div>
        </div>




    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/profesor/profesor_dev_llaves.js"></script>
    <!--<script src="./public/js/profesor/profesor_geo_llave.js"></script>-->

</body>

</html>