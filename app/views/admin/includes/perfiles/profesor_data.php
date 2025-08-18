  <!-- Modal INFORMACION DE PROFESOR -->
  <div class="modal fade" id="professor_data_modal" tabindex="-1" aria-labelledby="professor_data_modal_label" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
          <div class="modal-content d-flex justify-content-center align-items-center"
              style="background-color: rgba(0, 0, 0, 0); overflow: hidden;">

              <div id="profile_screen" style="width: 99%; height: 99%;"
                  class="d-flex flex-xl-row flex-column m-1 bg-white rounded">

                  <!-- Datos del profesor -->
                  <aside id="profile_professor_data" style="scrollbar-width: thin;"
                      class="d-flex flex-column justify-content-start align-items-center col-12 col-xl-3 placeholder-glow p-4">
                      <h3 class="mb-2 w-100 profesor-data-title">Datos de Profesor</h3>

                      <label for="image_profile" class="form-label w-100">Foto de perfil</label>
                      <div id="image_profile" class="d-flex justify-content-center align-items-center my-3 gap-3">
                          <!-- Imagen de perfil -->
                          <img id="ppic" src="..." alt="..." class="placeholder" />
                          <div class="d-flex flex-column justify-content-center align-items-center gap-2">

                              <!-- Cambiar imagen -->
                              <button id="btn_change_image_profile" disabled
                                  class="btn btn-primary d-flex justify-content-center align-items-center gap-1 fw-semibold">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                      class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-check">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                      <path d="M13.5 6.5l4 4" />
                                      <path d="M15 19l2 2l4 -4" />
                                  </svg>
                                  <span class="">Cambiar</span>
                              </button>
                            <input class="d-none" type="file" name="in_pp_prof" id="in_pp_prof" accept="image/*">

                              <!-- Eliminar imagen -->
                              <button id="btn_delete_image_profile" disabled
                                  class="btn btn-danger d-flex justify-content-center align-items-center gap-1 fw-semibold">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                      class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 7h16" />
                                      <path d="M10 11v6" />
                                      <path d="M14 11v6" />
                                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                      <path d="M9 7v-3h6v3" />
                                  </svg>
                                  <span class="">Eliminar</span>
                              </button>
                          </div>
                      </div>


                      <section id="professor_data_section" class="placeholder-glow col-12 mt-2">

                          <!-- CEDULA -->
                          <div class="mb-3">
                              <label for="cedula" class="form-label">Número de cédula <span
                                      class="fw-light">(no editable)</span></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_cedula">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M7 12h3v4h-3z" />
                                          <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                                          <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                          <path d="M14 16h2" />
                                          <path d="M14 12h4" />
                                      </svg>
                                  </span>
                                  <input type="text" class="form-control placeholder" id="cedula" placeholder="Cédula"
                                      aria-label="cedula" aria-describedby="label_cedula" readonly>
                              </div>
                          </div>


                          <!-- Nombre completo -->
                          <div class="mb-3">
                              <label for="nombre_completo" class="form-label">Nombre completo <strong
                                      style="color: red;">*</strong></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_nombre_completo">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                      </svg>
                                  </span>
                                  <input type="text" class="form-control placeholder" id="nombre_completo" placeholder="Nombre completo"
                                      aria-label="nombre_completo" aria-describedby="label_nombre_completo">
                              </div>
                          </div>

                          <!-- Correo Institucional -->
                          <div class="mb-3">
                              <label for="correo_institucional" class="form-label">Correo institucional <strong
                                      style="color: red;">*</strong></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_correo_institucional">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-mail">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path
                                              d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z" />
                                          <path
                                              d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z" />
                                      </svg>
                                  </span>
                                  <input type="email" class="form-control placeholder" id="correo_institucional"
                                      placeholder="Correo institucional" aria-label="correo_institucional"
                                      aria-describedby="label_correo_institucional">
                              </div>
                          </div>

                          <!-- Nueva contraseña opcional -->
                          <div class="mb-3">
                              <label for="nueva_contrasena" class="form-label">Nueva contraseña <span
                                      class="fw-light">(opcional)</span></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_nueva_contrasena">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-lock-password">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                          <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                          <path d="M15 16h.01" />
                                          <path d="M12.01 16h.01" />
                                          <path d="M9.02 16h.01" />
                                      </svg>
                                  </span>
                                  <input type="text" class="form-control placeholder" id="nueva_contrasena"
                                      placeholder="Nueva contraseña (opcional)" aria-label="nueva_contrasena"
                                      aria-describedby="label_nueva_contrasena">
                              </div>
                          </div>

                          <!-- Número telefónico -->
                          <div class="mb-3">
                              <label for="numero_telefonico" class="form-label">Número telefónico <strong
                                      style="color: red;">*</strong></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_numero_telefonico">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path
                                              d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                      </svg>
                                  </span>
                                  <input type="tel" class="form-control placeholder" id="numero_telefonico"
                                      placeholder="Número telefónico" aria-label="numero_telefonico"
                                      aria-describedby="label_numero_telefonico">
                              </div>
                          </div>

                          <!-- Correo personal -->
                          <div class="mb-3">
                              <label for="correo_personal" class="form-label">Correo personal <span
                                      class="fw-light">(opcional)</span></label>
                              <div class="input-group">
                                  <span class="input-group-text" id="label_correo_personal">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                          class="icon icon-tabler icons-tabler-outline icon-tabler-mail-spark">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path
                                              d="M19 22.5a4.75 4.75 0 0 1 3.5 -3.5a4.75 4.75 0 0 1 -3.5 -3.5a4.75 4.75 0 0 1 -3.5 3.5a4.75 4.75 0 0 1 3.5 3.5" />
                                          <path d="M11.5 19h-6.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v5" />
                                          <path d="M3 7l9 6l9 -6" />
                                      </svg>
                                  </span>
                                  <input type="email" class="form-control placeholder" id="correo_personal"
                                      placeholder="Correo personal" aria-label="correo_personal" aria-describedby="label_correo_personal">
                              </div>
                          </div>

                      </section>

                      <div class="d-flex flex-column justify-content-center align-items-center gap-2 mt-2 w-100">
                          <button id="btn_save_professor_profile_changes"
                              class="btn btn-success fw-semibold w-100 d-flex justify-content-center align-items-center pt-2"
                              disabled>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="icon icon-tabler icon-tabler-check">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M5 12l5 5l10 -10" />
                              </svg>
                              <span class="ms-2">Guardar datos</span>
                          </button>

                          <button id="btn_delete_professor_profile"
                              class="btn btn-danger fw-semibold w-100 d-flex justify-content-center align-items-center pt-2" disabled>
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="icon icon-tabler icon-tabler-trash">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M4 7h16" />
                                  <path d="M10 11v6" />
                                  <path d="M14 11v6" />
                                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                  <path d="M9 7v-3h6v3" />
                              </svg>
                              <span class="ms-2">Eliminar profesor</span>
                          </button>

                          <button id="btn_cancel_professor_profile_changes" data-bs-dismiss="modal"
                              class="btn btn-secondary fw-semibold w-100 d-flex justify-content-center align-items-center pt-2">
                              <span>Regresar</span>
                          </button>

                  </aside>

                  <!-- Datos de especialidades y horarios por especialidad -->
                  <div id="sch_info_container" class="d-flex flex-column col-12 col-xl-9 p-4 ">

                      <!-- Especialidades -->
                      <section id="specialties"
                          class="d-flex flex-xl-row flex-column justify-content-between align-items-center col-12 placeholder-glow gap-2"
                          style="height: fit-content;">

                          <h3 class="profesor-data-title col-12 col-xl-2">Especialidades</h3>

                          <div id="specialties_list&add"
                              class="col-12 col-xl-10 d-flex flex-xl-row flex-column justify-content-end align-items-center gap-2">

                              <!-- LISTA DE ESPECIALIDADES -->
                              <div id="sp_ls" class="d-flex gap-2 overflow-x-auto col-xl-9 col-12 align-items-center"
                                  style="scrollbar-width: thin; ">

                                  <!-- WAIT SPECIALITIES COMPONENT  -->
                                  <button id="wait_specialities" type="button" class="placeholder rounded-pill btn"
                                      style="min-width: 200px;"></button>

                              </div>

                              <!-- AGREGAR ESPECIALIDAD -->
                              <button type="button" data-bs-toggle="dropdown" aria-expanded="false" id="add_specialty"
                                  class="col-12 col-xl-2 rounded fw-bold btn btn-success d-flex justify-content-center align-items-center gap-1 fw-semibold">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                      class="icon icon-tabler icon-tabler-plus">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M12 5v14m-7 -7h14" />
                                  </svg>
                                  <span>Agregar especialidad</span>
                              </button>

                              <!-- SELECT DE LA ESPECIALDIAD -->
                              <ul class="dropdown-menu p-3">
                                  <p class="mb-1 fw-semibold">Seleccione una especialidad para agregar al profesor:</p>
                                  <select id="submit_specialty_select" class="form-select mb-3">
                                      <!-- <option value="1">Especialidad 1</option> -->
                                      <?php foreach ($especialidades as $key => $value) {
                                            // $value = $value->getData();
                                            // $key = $value->getId();
                                            // $value = $value->getNombre();
                                            if ($value[1] != 'Administrador') {
                                        ?>
                                              <option value="<?php echo $value[0]; ?>"><?php echo $value[1]; ?></option>
                                      <?php }
                                        } ?>
                                  </select>

                                  <button id="btn_submit_specialty" type="button" class="w-100 fw-semibold btn btn-success">Agregar
                                      especialidad</button>
                              </ul>

                          </div>

                      </section>

                      <!-- Horario por especialidad -->
                      <section id="schedule_area" class="placeholder mt-4 d-flex flex-column w-100 h-100 rounded">

                          <hr class="mt-0" />

                          <p id="empty_sch_msg" class="d-block">No hay horarios asignados para este profesor, agregue una especialidad para gestionar un horario.</p>

                          <div id="esp_schs_container" class="d-flex justify-content-between align-items-center flex-lg-row flex-column gap-2 px-1">


                              <!-- BOTON PARA CAMBIAR HORARIO ENTRE NOC/DIURNO -->
                              <div id="change_sch_mode_dr" class=" col-md-auto col-12">

                                  <button id="change_sch_mode" class="sch_diurno btn fw-bold text-white btn-primary border-0 fs-6 col-12 d-flex justify-content-center align-items-center gap-2"
                                      type="button">
                                      <span id="change_sch_mode_text">
                                          <span id="esp_showed"></span>
                                          <span class="mx-1">·</span>
                                          <span id="sch_mode">Horario diurno</span>
                                      </span>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-repeat">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                          <path d="M4 12v-3a3 3 0 0 1 3 -3h13m-3 -3l3 3l-3 3" />
                                          <path d="M20 12v3a3 3 0 0 1 -3 3h-13m3 3l-3 -3l3 -3" />
                                      </svg>
                                  </button>
                              </div>

                              <span id="last_date_update_sch">
                                  <strong>Ultima Actualización:</strong>
                                  <span id="last_date_update_sch_value" class="">2023-10-01</span>
                              </span>
                          </div>

                          <!-- HORARIO -->
                          <div id="schedule_container" class="mt-2 p-2 overflow-scroll"
                              style="scrollbar-width: thin; height: 100%;">

                              <table id="schedule_table" class="table table table-sm">

                                  <!-- TITULOS DEL HORARIO -->
                                  <thead>
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
                                      <?php include 'sch_diurno.php' ?>

                                      <!-- Horario nocturno -->
                                      <?php include 'sch_nocturno.php' ?>
                                  </tbody>
                              </table>

                          </div>
                      </section>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal MODIFICAR BLOQUE LECTIVO-->
  <div class="modal fade" id="update_bloque_lectivo_modal" tabindex="-1"
      data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" data-bs-theme="dark" style="background-color:rgb(10, 51, 88); color: white;">
                  <h1 class="modal-title fs-5 text-white"><strong>Bloque lectivo:</strong> <span
                          id="hour_block_to_change"></span></h1>
                  <button type="button" class="btn-close text-white" style="box-shadow: none;" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="choose_subarea" class="form-label"><strong>Asigne una subárea:</strong></label>
                      <select id="choose_subarea" class="form-select">
                          <?php foreach ($subareas as $key => $value) { ?>
                              <option class="choose_subarea_option" value="<?php echo $value['idSubarea']; ?>" data-id-esp="<?php echo $value['idEspecialidad']; ?>"><?php echo $value['nombreSubarea']?></option>
                          <?php } ?>
                      </select>
                  </div>

                  <div class="mb-3">
                      <label for="choose_llave" class="form-label"><strong>Asigne una llave:</strong></label>
                      <select id="choose_llave" class="form-select">
                          <option value="999">Sin asignar</option>
                          <?php foreach ($llaves as $key => $value) {
                                if ($value['numeroLlave'] != 999) {
                            ?>
                                  <option value="<?php echo $value['numeroLlave']; ?>"><?php echo 'N°' . $value['numeroLlave'] . ' - ' . $value['nombreAula'] ?></option>
                          <?php }
                            } ?>
                      </select>
                  </div>

                  <div class="mb-3">
                      <label for="insert_group" class="form-label"><strong>Asigne el nombre un grupo:</strong></label>
                      <input type="text" class="form-control" id="insert_group"
                          placeholder="Dejar vacio si no se requiere">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Volver</button>
                  <button id="update_bloque_lectivo" type="button" class="btn btn-success fw-semibold">Actualizar bloque
                      lectivo</button>
              </div>
          </div>
      </div>
  </div>