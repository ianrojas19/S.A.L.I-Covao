<!-- Modal de actualizacion de perfil-->
<div class="modal fade" id="admin_data_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="min-height: 90vh;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profile_modal_label">Perfil de administrador</h1>
                <button type="button" style="box-shadow: none;" class="btn-close close_profile" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Loader -->
                <div id="loader_perfil" class="spinner-border mx-auto"
                    style="color:#164166 !important; margin-top:35%; display: none; height: 50px; width: 50px"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <div id="modal_body_perfil">

                    <!-- Ver perfil -->

                    <!-- Valores de foto de perfil -->

                    <label id="search_photo_container_admin" for="search_photo_perfil_admin"
                        class="d-flex flex-column justify-content-center align-items-center">

                        <!-- Imagen del perfil -->
                        <img id="search_photo_perfil_img_admin" src="./public/assets/images/fotos_perfil/default.webp"
                            class="photo_perfil" style="width: 170px; height:170px;"></img>
                        <div id="cover_search_image"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                            </svg></div>

                    </label>
                    <div id="delete_photo_profile_act" style="top: -55px !important"
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
                    <input type="file" name="search_photo_perfil_admin" id="search_photo_perfil_admin"
                        class="d-none search_user_input" accept="image/*">


                    <!-- Valores de cedula y rol -->
                    <p
                        class="search_no_editable_values scc d-flex justify-content-center align-items-center text-align-center">
                        <span class="fw-semibold">Cédula:</span>
                        <span id="search_ced"></span>
                    </p>

                    

                    <div class="mb-4 mt-4">
                        <label for="search_nombrecom" class="form-label">Nombre completo <b
                                style="color: red;">*</b></label>
                        <input type="text" class="form-control search_user_input" id="search_nombrecom"
                            name="search_nombrecom" required>
                        <div class="invalid-feedback">
                            El nombre ingresado no es válido.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="search_correoinst" class="form-label">Correo electrónico
                            institucional <b style="color: red;">*</b></label>
                        <input type="text" class="form-control search_user_input" id="search_correoinst"
                            name="search_correoinst" required>
                        <div class="invalid-feedback">
                            El correo electrónico ingresado no pertenece a <b>@covao.ed.cr</b>,
                            o pertene a otro usuario.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="search_contrainst" class="form-label">Nueva
                            contraseña</label>
                        <input type="text" class="form-control search_user_input" id="search_contrainst"
                            name="search_contrainst" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            data-bs-title="Si desea cambiar la contraseña del usuario, ingrese la nueva contraseña, si no, deje el espacio en blanco"
                            placeholder="Dejar en blanco si no quiere actualizar contraseña.">
                        <div class="invalid-feedback">
                            La contraseña debe tener al menos 8 caracteres.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="search_phonect" class="form-label">Número telefónico de
                            contacto <b style="color: red;">*</b></label>
                        <input type="text" class="form-control search_user_input" id="search_phonect"
                            name="search_phonect" required min="10000000">
                        <div class="invalid-feedback">
                            El número telefónico no es válido.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="search_correoct" class="form-label">Correo electrónico de
                            contacto</label>
                        <input type="email" class="form-control search_user_input" id="search_correoct"
                            name="search_correoct" placeholder="Dejar vacio si no desea ingresar un correo de contacto">
                        <div class="invalid-feedback">
                            El correo electrónico no es valido, si no desea ingresarlo deje el
                            campo vacio o escriba <b>n/a</b>.
                        </div>
                    </div>


                </div>
            </div>

            <!-- Botones de actualizar y creacion -->
            <div class="modal-footer d-flex justify-content-between">
                <div id="deleteProfile_admin" class="btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </div>
                <div class="d-flex gap-1">
                    <button type="button" class="btn btn-secondary d-flex close_profile" data-bs-dismiss="modal"
                        id="close_profile_modal">Atrás</button>
                    <button id="updateProfile_admin" type="button"
                        class="btn btn-success d-flex justify-content-center align-items-center"
                        style="min-width: 150px;">
                        <span id="loader_update_span">Guardar cambios</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>