<section>
    <div class='panel-title'>
        <div><a href='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='back'>Volver</button></a></div>
        <h3>AGREGAR</h3>
        <div></div>
    </div>
    <div class="<?php if ($successfulAction || $actionFailed || $existPlatform) echo $successfulAction ? "win_added_acc" : "fail_added_acc"; else echo 'hidden' ?>" >
        <div>
            <?php 
                if ($successfulAction)
                    echo "Plataforma agregada exitosamente";
                elseif ($actionFailed)
                    echo "Error: Acción fallida";
                elseif ($existPlatform)
                    echo "La plataforma ya existe";
            ?>
        </div>
        <div>
            <a href="platforms.php">
                <button class="accept">Aceptar</button>
            </a>
        </div>
    </div>
    <div class="<?php echo $successfulAction || $actionFailed || $existPlatform ? 'hidden' : 'perfil-info' ?>">
        <form action="<?php echo $_SERVER['PHP_SELF'].'?add'; ?>" method="POST" id="platform" enctype="multipart/form-data">
            <fieldset>
                <legend>Requerido</legend>
                <fieldset>
                    <legend>Categoría - subcategoría</legend>
                    <div class="div_select">
                        <div>Categorías:</div>
                        <select name="categories" id="categories"></select>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_select">
                        <div>Plataformas:</div>
                        <select name="subcategories" id="subcategories">
                            <option value="">-- Elija una opción --</option>
                        </select>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_input">
                            <div>Nombre de la cuenta:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="requerido (*)">
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                </fieldset>
            </fieldset>
            <fieldset>
                <legend>Opcional</legend>
                <fieldset>
                    <legend>Logo de la plataforma</legend>
                    <div class="preview">
                        <div class="preview_logo">
                            <p>No se ha seleccionado ningún archivo para cargar</p>
                        </div>
                    </div>
                    <div id="error"></div>
                    <div>
                        <label for="profile_pic"><u>Elija una imagen para cargar</u>: <b>(PNG) (Tamaño máximo: 50KB)</b></label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="51200" />
                        <input type="file" id="logo" name="logo" accept=".png">
                    </div>
                </fieldset>
            </fieldset>
            <div id="message_error"></div>
            <div>
                <input type="submit" id ="send" name="add_platform" value="Aceptar" class="accept">
            </div>
        </form>
    </div>
</section>