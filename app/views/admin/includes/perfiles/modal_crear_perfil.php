<!-- Modal de creacion de perfil-->
<div class="modal fade" id="create_user_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Crear perfil</h1>
            </div>
            <div class="modal-body">
                <label id="create_photo_container" for="create_photo_perfil"
                    class="d-flex flex-column justify-content-center align-items-center">

                    <!-- Imagen del perfil -->
                    <label for="create_photo_perfil" class="form-label">Foto de perfil</label>
                    <img id="create_photo_perfil_img" src="./public/assets/images/fotos_perfil/default.webp"
                        class="photo_perfil"
                        style="width: 125px; height: 125px; margin-top: 10px; object-fit: cover;"></img>
                    <div id="cover_search_image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </div>

                </label>

                <div id="delete_photo_profile_create"
                    class="d-flex justify-content-center align-items-center btn btn-danger mx-auto"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar foto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-photo-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 8h.01" />
                        <path d="M13 21h-7a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3 3" />
                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0" />
                        <path d="M22 22l-5 -5" />
                        <path d="M17 22l5 -5" />
                    </svg>
                </div>

                <!-- Input real de la foto de perfil -->
                <input type="file" name="create_photo_perfil" id="create_photo_perfil" class="d-none create_user_input"
                    accept="image/*">

                <!-- CEDULA -->
                <div class="mb-4 mt-4">
                    <label for="create_ced" class="form-label">Cédula (solo números) <b
                            style="color: red;">*</b></label>
                    <input type="text" class="form-control create_user_input" id="create_ced" name="create_ced" required
                        placeholder="Ej: 101110111" maxlength="9">
                    <div class="invalid-feedback">
                        La cedúla ingresada no es válida o pertenece a otro usuario.
                    </div>
                    <div class="valid-feedback">
                        Cedúla válida y disponible.
                    </div>
                </div>

                <!-- NOMBRE COMPLETO -->
                <div class="mb-4 mt-4">
                    <label for="create_nombrecom" class="form-label">Nombre completo <b
                            style="color: red;">*</b></label>
                    <input type="text" class="form-control create_user_input" id="create_nombrecom"
                        name="create_nombrecom" required>
                    <div class="invalid-feedback">
                        El nombre ingresado no es válido.
                    </div>
                </div>


                <!-- ROL INSTITUCIONAL -->
                <div class="mb-4 mt-4">
                    <label for="create_rol" class="form-label">Rol institucional <b style="color: red;">*</b></label>
                    <select class="form-select create_user_input" name="create_rol" id="create_rol">
                        <option selected value="1">Administrador</option>
                        <option value="2">Profesor</option>
                    </select>
                </div>


                <!-- ESPECIALIDAD -->
                <div id="create_esp_cont" class="mb-4 mt-4 d-none">
                    <label for="create_esp" class="form-label">Especialidad <b style="color: red;">*</b></label>
                    <select class="mb-1 form-select create_user_input" name="create_esp" id="create_esp">
                        <option selected value="not_set">Seleccione una especialidad</option>
                        <?php
                        foreach ($especialidades as $key => $value) {
                            if ($value[0] != 1) {
                                ?>
                                <option selected value="<?php echo $value[0] ?>"><?php echo $value[1] ?>
                                </option>
                                <?php
                            } else {
                                ?>
                                <option style="display: none;" id="value_esp_admin" value="<?php echo $value[0] ?>">
                                    <?php echo $value[1] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <p id="warn_professors_esp" class="text-secondary ms-1" style="font-size: 14px;">Podrá gestionar todas las especialidades del profesor una vez creado el perfil.</p>
                </div>

                <!-- CORREO ELECTRONICO INSTITUCIONAL -->
                <div class="mb-4">
                    <label for="create_correoinst" class="form-label">Correo electrónico
                        institucional <b style="color: red;">*</b></label>
                    <input type="email" class="form-control create_user_input" id="create_correoinst"
                        name="create_correoinst" required placeholder="Ej: usuario@covao.ed.cr">
                    <div class="invalid-feedback">
                        El correo electrónico ingresado pertenece a otro usuario, o la extensión
                        del correo no pertenece a <b>@covao.ed.cr</b>
                    </div>
                </div>

                <!-- CONTRASEÑA DE CORREO ELECTRONICO INSTITUCIONAL -->
                <div class="mb-4">
                    <label for="create_contrainst" class="form-label">Contraseña (Min. 8
                        caractéres)<b style="color: red;">*</b></label>
                    <input type="text" class="form-control create_user_input" id="create_contrainst"
                        name="create_contrainst" required minlength="8">
                    <div class="invalid-feedback">
                        La contraseña debe tener al menos 8 caracteres.
                    </div>
                </div>


                <!-- NUMERO TELEFONICO DE CONTACT -->
                <div class="mb-4">
                    <label for="create_phonect" class="form-label">Número telefónico de contacto
                        <b style="color: red;">*</b></label>
                    <input type="tel" class="form-control create_user_input" id="create_phonect" name="create_phonect"
                        required>
                    <div class="invalid-feedback">
                        El número telefónico no es válido, solamente se permiten números.
                    </div>
                </div>


                <!-- CORRECO ELECTRONICO DE CONTACTO -->

                <div class="mb-3">
                    <label for="create_correoct" class="form-label">Correo electrónico de
                        contacto</label>
                    <input type="email" class="form-control create_user_input" id="create_correoct"
                        name="create_correoct" placeholder="Si no desea ingresar un correo, deje vacio el campo.">
                    <div class="invalid-feedback">
                        El correo electrónico no es valido, si no desea ingresarlo deje el campo
                        vacio o escriba <b>n/a</b>.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="quit_create" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atrás</button>
                <button id="create_profile_btn" type="button" class="btn btn-success">
                    <span id="create_profile_text" class="fw-semibold">Crear perfil</span>
                </button>
            </div>
        </div>
    </div>
</div>