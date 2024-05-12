<section>
    <div class='panel-title'>
        <div><a href='<?php echo $_SERVER['PHP_SELF']; ?>'><button class='back'>Volver</button></a></div>
        <h3>EDITAR</h3>
        <div></div>
    </div>
    <div class="<?php $successfulAction ? "win_added_acc" : "hidden"; ?>" >
        <div><?php echo $successfulAction ? "Plataforma actualizada exitosamente" : ""; ?></div>
        <div>
            <a href="platforms.php" class="<?php echo $successfulAction ? '' : 'hidden' ?>">
                <button class="accept">Aceptar</button>
            </a>
        </div>
    </div>
    <div class="<?php echo $successfulAction ? 'hidden' : 'perfil-info' ?>">
        <form action="<?php echo $_SERVER['PHP_SELF'].'?edited'; ?>" method="POST" id="platform" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $search_platform[0]['id']; ?>">
            <fieldset>
                <legend>Requerido</legend>
                <fieldset>
                    <legend>Categoría - subcategoría</legend>
                    <div class="div_select">
                        <div>Categorías: </div><div class="capitalice"><?php echo replaceCharacterByOtherCharacter($search_platform[0]['category'],array("_"),array(" ")) ?></div>
                    </div>
                    <div class="div_select">
                        <div>Plataformas:</div>
                        <?php
                            renderSubcategorySelect($subcategories, $search_platform[0]['subcategory']);
                        ?>
                        <div class="special_message">
                            <span class="text-error"></span>
                        </div>
                    </div>
                    <div class="div_input">
                            <div>Nombre de la cuenta:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="requerido (*)" value="<?php echo $search_platform[0]['name']; ?>">
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
                            <img src="../img/platform/<?php echo $logo; ?>">
                            <p>Logo actual disponible para esta plataforma</p>
                        </div>
                    </div>
                    <div id="error"></div>
                    <div>
                        <label for="profile_pic"><u>Elige una imagen para cargar</u>: <b>(PNG) (Tamaño-Máx: 50KB)</b></label><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="51200" />
                        <input type="file" id="logo" name="logo" accept=".png">
                    </div>
                </fieldset>
            </fieldset>
            <div id="message_error"></div>
            <div>
                <input type="submit" id ="send" name="edit_platform" value="Aceptar" class="accept">
            </div>
        </form>
    </div>
</section>