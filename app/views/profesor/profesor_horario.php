<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-180x180.png" type="image/x-icon">
    <link rel="shortcut icon" href="./public/assets/images/covao/favicon-192x192.png" type="image/x-icon">
    <script src="./public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./public/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/profesor/profesor_horario.css">
    <title>SALI · Mi Horario</title>
    <style>
        #sp_list label{
            min-width: max-content;
        }
        
        .btn_diurno{
            background-color: #095da6;
        }
        
        .btn_diurno:hover, .btn_nocturno:hover{
            background-color: #095da6 !important;
        }
        
        .btn_nocturno{
            background-color: #143e63;
        }
        
        /*HORARIO*/
        #schedule_area {
            overflow-y: auto;
        }

        #schedule_area thead {
            position: sticky;
            top: -8px;
            z-index: 30;
        }


        .specialty {
            transition: background-color 0.3s;
            background-color: #19446a;
            color: white;
            border-color: #19446a;
            min-width: fit-content;
            max-width: fit-content;
            border-radius: 100px !important;
            text-transform: capitalize;
            z-index: 222222222;
        }

        #profile_professor_data {
            overflow-y: auto;
            overflow-x: hidden;
            height: 100%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* min-width: 350px; */
        }

        #sp_ls {
            width: fit-content;
            max-width: 600px;
        }

        #add_specialty {
            width: fit-content;
        }

        #schedule_area.placeholder * {
            visibility: hidden;
        }

        .sch_diurno {
            background-color: #0b66b6;
        }

        .sch_nocturno {
            background-color: #0d4678;
        }

        @media (max-width: 1200px) {

            #change_sch_mode_button,
            #change_sch_mode {
                width: 100%;

            }

            #profile_screen {
                overflow-y: scroll !important;
            }

            #add_specialty {
                width: 100% !important;
            }


            #profile_professor_data {
                overflow: visible;
                height: fit-content;
            }

            #sp_ls {
                max-width: 100%;
            }

        }

        .input-group-text {
            background-color: #19446a !important;
            color: white !important;
        }

        #profile_professor_data .form-label {
            color: #1f5381 !important;
            font-weight: 600 !important;
            font-size: 1.1rem !important;
            margin-bottom: 0rem !important;
        }

        #schedule_area strong,
        #schedule_area span {
            text-align: center;
        }

        #profile_professor_data img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profesor-data-title {
            color: #19446a;
            font-weight: bolder;
        }

        .first_mhtd {
            background-color: #19446a !important;
            color: white;
            padding: 10px !important;
            cursor: default !important;
            height: fit-content !important;
        }

        .mhtd {
            height: 125px;
            min-width: 180px;
            min-height: fit-content;
            padding: 20px;
            border-bottom: 1px solid #0b66b61e;
            transition: 0.2s all ease;
            position: relative;
        }

        .mhtd .llave,
        .mhtd .subarea,
        .mhtd .grupo {
            /* max-width: 140px; */
            white-space: nowrap;
            /* overflow: hidden; */
            /* text-overflow: ellipsis; */
            display: inline-block;
        }

        .mhtd .grupo {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 0 0 4px 10px;
            color: #19446a;
            background-color: rgba(61, 145, 219, 0.1);
            padding: 2px 10px;
            font-size: 14px;
            border-radius: 4px;
        }

        .bloque_hora {
            background-color: #2828280e;
        }

        .mhtd:hover:not(.bloque_hora) {
            background-color: #0e75ce2c;
            border-bottom: 1px solid #0b66b6 !important;
            /*cursor: pointer;*/
        }

        .mhtd.mhtd_empty {
            border-bottom: 1px solid #0b66b61e !important;
            color:rgba(0, 0, 0, 0.3) !important;
        }

        .mhtd.mhtd_empty:hover {
            background-color: rgb(239, 239, 239) !important;
            border-bottom: 1px solid #0b66b61e !important;
        }

        #schedule_table th,
        #schedule_table td {
            padding: 0 !important;
        }

        .crud_specialty {
            transition: background-color 0.3s;
            background-color: #ffffff00;
            color: white;
            border-color: #19446a;
            min-width: fit-content;
            border-radius: 100px !important;
            padding: 2px;
        }

        .crud_specialty:hover {
            background-color: #ffffff3c;
            color: #ffff;
            border-color: #1f5381;
        }
    </style>
</head>

<body>

    

    <?php require 'includes/header.php' ?>

    <?php require 'includes/back_to_main.php' ?>

    

    <main class="px-3 pb-5 mx-auto" style="min-height: 90vh; max-width: 1200px;">

    <div id="wait_sch" class="mt-5 d-flex justify-content-center align-items-center flex-column">
        
        <div class="spinner-grow text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
</div>
    </div>
    <div id="main_content" class="d-none">
          <h3 style="color: #143e63" class="mt-4 fw-semibold">
        Especialidades
    </h3>
    <p class="mb-2 mt-1">Seleccione una especialidad para visualizar el horario:</p>
    <div id="sp_list" class="d-flex col-12 pb-2 gap-2 mb-2" style="overflow-x: auto;">
    </div>
    
    <div id="sch_container" class="d-flex flex-column gap-2 col-12 ">
         <button id="switch_sch_mode" class="btn btn_diurno gap-2 fw-bold d-flex justify-content-center align-items-center text-white" type="button">
            <span id="shown_sp"></span>
            <span>·</span>
            <span id="sch_mode">Horario diurno</span>
            <svg  xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2.2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-repeat"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 12v-3a3 3 0 0 1 3 -3h13m-3 -3l3 3l-3 3" /><path d="M20 12v3a3 3 0 0 1 -3 3h-13m3 3l-3 -3l3 -3" /></svg>
         </button>
         
         
          <!-- HORARIO -->
                          <div id="schedule_container" class="mt-2 p-2 overflow-auto"
                              style="scrollbar-width: thin;">

                              <table id="schedule_table" class="table table-sm">

                                  <!-- TITULOS DEL HORARIO -->
                                  <thead style="position: sticky; top: -8px; z-index: 99;">
                                      <tr>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Hora y Lección</strong>

                                              </div>
                                          </th>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Lunes</strong>

                                              </div>
                                          </th>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Martes</strong>

                                              </div>
                                          </th>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Miércoles</strong>

                                              </div>
                                          </th>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Jueves</strong>

                                              </div>
                                          </th>
                                          <th>
                                              <div
                                                  class="first_mhtd mhtd d-flex flex-column justify-content-center align-items-center fw-bold">
                                                  <strong>Viernes</strong>

                                              </div>
                                          </th>
                                      </tr>
                                  </thead>

                                  <tbody>

                                      <!-- Horario diurno -->
                                      <?php include './app/views/admin/includes/perfiles/sch_diurno.php' ?>

                                      <!-- Horario nocturno -->
                                      <?php include './app/views/admin/includes/perfiles/sch_nocturno.php' ?>
                                  </tbody>
                              </table>

                          </div>
    </div>
    </main>
    </div>


    <footer>SALI · COVAO © <span id="app_year"></span></footer>
    <script src="./public/js/profesor/profesor_horario.js"></script>
    <script src="./public/js/loader.js"></script>
</body>

</html>