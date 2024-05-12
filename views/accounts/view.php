<?php
    $route = file_exists("../img/platform/".normalizeString($result_search[0]['name']).".png") ? "../img/platform/".normalizeString($result_search[0]['name']).".png" : "../img/platform/other.png";
?>
<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Volver</button></a></div>
        <h3>CUENTA</h3>
        <div</div>
    </div>
    <div class='account scroll'>
        <article>
            <div class='platform'>
                <img src="<?php echo $route; ?>" alt="<?php echo 'Logo '.$result_search[0]['name']; ?>">
                <h3><?php echo $result_search[0]['name']; ?>:</h3>
            </div>
            <div class='basic-info'>
                <form id="form-view">
                    <input type="hidden" name="search" value="<?php echo $_GET['view']; ?>">
                    <fieldset>
                        <legend>Acceso - Inicio de sesión</legend>
                        <fieldset class="<?php echo ($result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)'] !== "" ? "" : 'hidden'); ?>">
                            <legend>Dirección de la cuenta</legend>
                            <div>
                                <b><u>URL / IP</u>:</b>
                            </div>
                            <div>
                                <span>
                                    <?php
                                        echo (
                                            $result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)'] !== "" ? 
                                            "<a href='".$result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)']."' target='_blank' class='word-break'>".$result_search[0]['AES_DECRYPT(UNHEX(A.url),K.password)']."</a>" :
                                            "No disponible"
                                        );
                                    ?>
                                </span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Datos de inicio de sesión</legend>
                            <div class="view_account-pass">
                                <div>
                                    <div>
                                        <b><u>Cuenta</u>:</b>
                                    </div>
                                    <div>
                                        <span class="word-break"><?php echo $result_search[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']; ?></span>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <b><u>Contraseña</u>:</b>
                                        <span class="alert"><?php echo $result_search[0]['DATEDIFF(CURDATE(), A.pass_date)'] >= $_SESSION['user']['days_old_password'] ? "ESTA CONTRASEÑA TIENE MÁS DE ".$_SESSION['user']['days_old_password']." DÍAS" : ""; ?></span>
                                    </div>
                                    <div class="box-info">
                                        <div class="info">
                                            <div id="shps" class="eye">
                                                <input type="checkbox" name="shps">
                                            </div>
                                            <div class="word-break"><?php echo replaceByCharacter($result_search[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)'],'*'); ?></div>
                                        </div>
                                        <div class="text-right">
                                            <input type="submit" id="cp_pss" value="Copiar" class="copy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </fieldset>
                    <fieldset>
                        <legend>Datos adicionales</legend>
                        <fieldset>
                            <legend>Notas</legend>
                            <div class="div_textarea">
                                <div><u>Notas personales</u>:</div>
                                <div class="div_pass">
                                    <div></div>
                                    <textarea name="notes" id="notes" maxlength="255" disabled><?php echo replaceCharacterByOtherCharacter( $result_search[0]['AES_DECRYPT(UNHEX(A.notes),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></textarea>
                                </div>
                                <div></div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Información sensible</legend>
                            <div class="div_textarea">
                                <div><u>Información adicional</u>:</div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo">
                                    </div>
                                    <textarea name="info" id="info" maxlength="255" disabled><?php echo replaceByCharacter( replaceCharacterByOtherCharacter( $result_search[0]['AES_DECRYPT(UNHEX(A.info),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ), '*' ); ?></textarea>
                                </div>
                                <div></div>
                            </div>
                        </fieldset>
                    </fieldset>
                </form>
                <div class="panel-dual_button">
                    <a href="<?php echo 'accounts.php?edit='.$result_search[0]['id']; ?>">
                        <button class="back">Editar</button>
                    </a>
                    <a href="<?php echo 'accounts.php?del='.$result_search[0]['id']; ?>">
                        <button class="cancel">Eliminar</button>
                    </a>
                </div>
            </div>
        </article>
    </div>
</section>