<section>
    <div class='panel-title'>
        <div><a href='accounts.php?view=<?php echo $_GET['edit'] ?>'><button class="back">Volver</button></a></div>
        <h3>EDITAR</h3>
        <div></div>
    </div>
    <div class='account scroll'>
        <div class="<?php if ($editedAcount || $failuredAcount) echo $editedAcount ? 'win_added_acc' : 'fail_added_acc'; else echo 'hidden'; ?>" > <!-- win_added_acc --> <!-- registered-box dm10 -->
            <div><?php echo $editedAcount ? "Cuenta editada exitosamente" : "Error al editar la cuenta"; ?></div>
            <div>
                <a href="accounts.php?<?php echo 'view='.$_GET['edit'] ?>">
                    <button class="accept">Aceptar</button>
                </a>
            </div>
        </div>
        <article class="<?php echo $editedAcount || $failuredAcount ? 'hidden' : ''; ?>">
            <div class="basic-info">
                <form id="form-add" action="accounts.php?edit=<?php echo $_GET['edit']; ?>" method="POST">
                    <fieldset class="select_platform">
                        <legend>Plataforma</legend>
                        <div class="div_select">
                            <div>Categorías:</div>
                            <div id="category"><?php echo $platformListByCategory[0]['category'] ?></div>
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                        <div class="div_select">
                            <div>Plataformas:</div>
                            <?php
                                renderPlatformSelect($platformListByCategory,$dataAccount[0]['idPlatform']);
                            ?>
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Datos de la cuenta</legend>
                        <div class="div_input">
                            <div>Nombre de la cuenta:</div>
                            <!-- <input type="text" value="<?php echo $dataAccount[0]['name_account']?>" disabled> -->
                            <input type="text" name="name" id="name" class="required" placeholder="requerido (*)" value="<?php echo $dataAccount[0]['AES_DECRYPT(UNHEX(A.name_account),K.password)']; ?>">
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                        <div id="acc_name_rep" class="hidden"></div>
                        <!-- CONTRASEÑA -->
                        <fieldset class="password">
                            <legend>Contraseña</legend>
                            <div id="oldPassMessage"><?php echo $dataAccount[0]['DATEDIFF(CURDATE(), A.pass_date)'] >= $_SESSION['user']['days_old_password'] ? "CONTRASEÑA DEMASIADO ANTIGUA" : ""; ?></div>
                            <div class="div_input">
                                <div>Contraseña:</div>
                                <div class="div_pass">
                                    <div id="shps" class="eye">
                                        <input type="checkbox" name="shps">
                                    </div>
                                    <input type="password" name="pass" id="pass" class="required" placeholder="requerido (*)" value="<?php echo $dataAccount[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)']; ?>">
                                </div>
                                <div class="special_message">
                                    <span></span>
                                </div>
                            </div>
                            <div class="div_input">
                                <div>
                                    Repetir contraseña:
                                </div>
                                <div class="div_pass">
                                    <div id="shpsr" class="eye">
                                        <input type="checkbox" name="shpsr">
                                    </div>
                                    <input type="password" name="pswd_rep" id="pass_rep" class="required" placeholder="requerido (*)" value="<?php echo $dataAccount[0]['AES_DECRYPT(UNHEX(A.pass_account),K.password)']; ?>">
                                </div>
                                <div class="special_message">
                                    <span class="dangerous"></span>
                                </div>
                            </div>
                            <!-- GENERAR CONTRASEÑA -->
                            <div class="div_gen_pass">
                                <label class="bold text-error div_checkbox"><input type="checkbox" id="use_generate"><div>Usar sistema de generación de contraseñas</div></label>
                            </div>
                            <fieldset id="gen_panel" class="hidden">
                                <legend>Sistema de generación de contraseñas</legend>
                                <div>
                                    <label class="bold text-green"><input type="checkbox" id="special_char" checked>Caracteres especiales</label>
                                </div>
                                <div>
                                    <label><input type="number" min="6" max="64" value="20" id="number_char">Longitud de la contraseña (Recomendado: 20)</label>
                                </div>
                                <div class="div_gen-pass_button">
                                    <button id="gen_pass" class="accept">Aceptar</button>
                                </div>
                            </fieldset>
                        </fieldset>
                        <!-- FIN CONTRASEÑA -->
                        <fieldset>
                            <legend>Información adicional</legend>
                            <div class="div_input">
                                <div>
                                    URL / IP:
                                </div>
                                <div class="div_pass">
                                    <div id="shurl" class="eye_slash">
                                        <input type="checkbox" name="shurl">
                                    </div>
                                    <input type="text" name="url" id="url" placeholder="OPCIONAL" value="<?php echo $dataAccount[0]['AES_DECRYPT(UNHEX(A.url),K.password)']; ?>">
                                </div>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Notas (Información visible):
                                </div>
                                <div class="div_pass">
                                    <div id="shnotes" class="eye_slash">
                                        <input type="checkbox" name="shnotes">
                                    </div>
                                    <textarea name="notes" id="notes" placeholder="OPCIONAL" maxlength="255"><?php echo replaceCharacterByOtherCharacter( $dataAccount[0]['AES_DECRYPT(UNHEX(A.notes),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char"><?php echo strlen($dataAccount[0]['AES_DECRYPT(UNHEX(A.notes),K.password)']); ?>/255</span>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Información sensible (Información oculta):
                                </div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo" checked>
                                    </div>
                                    <textarea name="info" id="info" placeholder="OPCIONAL" maxlength="255" style="display: none;"><?php echo replaceCharacterByOtherCharacter( $dataAccount[0]['AES_DECRYPT(UNHEX(A.info),K.password)'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ); ?></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char" style="display: none;"><?php echo strlen($dataAccount[0]['AES_DECRYPT(UNHEX(A.info),K.password)']); ?>/255</span>
                            </div>
                        </fieldset>
                    </fieldset>
                    <div class="special_message">
                        <span class="dangerous"></span>
                    </div>
                    <input type="submit" name ="edit_account" id="save" value="Guardar" class="accept">
                </form>
            </div>
        </article>
    </div>
</section>