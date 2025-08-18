<!-- KEY -->
<div class="col key_container" data-kn='<?php echo $value["numeroLlave"] ?>' data-kan='<?php echo strtolower($value["nombreAula"]) ?>'
    data-kst='<?php echo $value["isTaken"] ?>' data-kru='<?php echo strtolower($value["razonUso"]) ?>'
    data-knp="<?php echo $name_prof ?>">
    <div class="key rounded border p-3">
        <div
            class="key_bg_state rounded justify-content-center align-items-center d-flex key_<?php echo $value["isTaken"] ?>">
            <?php
            if ($value["isTaken"] == 0) {
                ?>
                <img src="./public/assets/images/icons/cerradura.webp" width="45px" height="45px">

            <?php } else if ($value["isTaken"] == 1) {
                ?>
                    <img src="./public/assets/images/icons/cerradura_closed.webp" width="45px" height="45px">
                <?php
            }

            ?>
        </div>
        <div class="key_body_info pt-3">
            <p class="key_number fs-5 mb-1 mt-0 fw-bold">
                <b>Llave Nº<span><?php echo $value["numeroLlave"] ?></span></b>
            </p>

            <p class="key_room_name fs-6 mb-1 mt-0 fw-medium">
                <b>Aula:</b>
                <span><?php echo $value['nombreAula'] ?></span>
            </p>

            <div class="key_user fs-6 mb-2 mt-0 fw-medium d-flex justify-content-start align-items-center gap-1">
                <div><b>Portador(a):</b></div>
                <input class="form-control key_portador" list="datalistProfesores" value="<?php echo $name_prof ?>"
                    placeholder="Ingrese el nombre del portador" <?php echo $value["razonUso"] != 'use_by_sch' && $value["isTaken"] != 0 ? '' : 'readonly' ?>></input>

                <datalist id="datalistProfesores">
                    <?php
                    foreach ($users as $key => $profesor) {
                        if ($profesor[10] == 1 && $profesor[7] != 'Administrador') {
                            ?>
                            <option value="<?php echo $profesor[1] ?>">
                                <?php
                        }
                    }
                    ?>
                </datalist>
            </div>

            <hr class="mb-2 mt-1">
            <p class="text-center fs-5 mb-2 fw-semibold" style="color: #164166">Estado de llave
            </p>
            <div class="key_state fs-6 mb-2 mt-0 fw-medium d-flex justify-content-start align-items-center gap-2">
                <?php if ($value["isTaken"] == 0) { ?>
                    <input type="radio" class="btn-check btn_change_key_state disponible"
                        id="btn_state_free_<?php echo $value['numeroLlave'] ?>" autocomplete="off" data-free-key="0" 
                        name="btn_state_group_<?php echo $value['numeroLlave'] ?>" checked>
                    <label class="btn btn-outline-success key_state_sign fw-semibold btn rounded w-50"
                        for="btn_state_free_<?php echo $value['numeroLlave'] ?>">Disponible</label>

                    <input type="radio" class="btn-check btn_change_key_state ocupada"
                        id="btn_state_blocked_<?php echo $value['numeroLlave'] ?>" autocomplete="off" data-free-key="1"
                        name="btn_state_group_<?php echo $value['numeroLlave'] ?>">
                    <label class="btn btn-outline-secondary key_state_sign fw-semibold btn rounded w-50"
                        for="btn_state_blocked_<?php echo $value['numeroLlave'] ?>">Ocupada
                    </label>
                    <?php
                } else {
                     
                        ?>
                        <input type="radio" class="btn-check btn_change_key_state disponible"
                            id="btn_state_free_<?php echo $value['numeroLlave'] ?>" autocomplete="off" data-free-key="0"
                            name="btn_state_group_<?php echo $value['numeroLlave'] ?>">
                        <label class="btn btn-outline-success key_state_sign fw-semibold btn rounded w-50"
                            for="btn_state_free_<?php echo $value['numeroLlave'] ?>">Disponible
                        </label>
                        <?php
                    
                    ?>
                    <input type="radio" class="btn-check btn_change_key_state ocupada"
                        id="btn_state_blocked_<?php echo $value['numeroLlave'] ?>" autocomplete="off" data-free-key="1"
                        name="btn_state_group_<?php echo $value['numeroLlave'] ?>" checked>
                    <label class="btn btn-outline-secondary key_state_sign fw-semibold btn rounded w-50"
                        for="btn_state_blocked_<?php echo $value['numeroLlave'] ?>">Ocupada
                    </label>
                    <?php
                }
                ?>
            </div>
            <hr>

            <p class=" fs-5 mb-1 fw-semibold" style="color: #164166">Razón de uso de llave
            </p>

            <?php
            if ($value["isTaken"] == 1 && $value['razonUso'] == 'use_by_sch') {
                ?>
                <textarea id="texta_<?php echo $value['numeroLlave'] ?>" placeholder="Uso regular por horario"
                        class="key_use_reason form-control">Uso regular por horario</textarea>

                <?php
            } else if ($value["isTaken"] == 1 && $value['razonUso'] != 'use_by_sch') {
                ?>
                    <textarea id="texta_<?php echo $value['numeroLlave'] ?>" placeholder="<?php echo $value['razonUso']; ?>"
                        class="key_use_reason form-control"><?php echo $value['razonUso']; ?></textarea>
                <?php
            } else {
                ?>
                    <textarea id="texta_<?php echo $value['numeroLlave'] ?>" placeholder="Ingrese una razón de uso..." class="key_use_reason form-control"
                        readonly><?php echo $value['razonUso']; ?></textarea>
                <?php
            }

            ?>

            <button class="act_key_info btn mt-3 w-100" disabled>
                Actualizar llave
            </button>

        </div>
    </div>
</div>