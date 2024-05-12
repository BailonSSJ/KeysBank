<section>
    <div class='panel-title'>
        <div><a href='accounts.php'><button class="back">Volver</button></a></div>
        <h3>AGREGAR</h3>
        <div</div>
    </div>
    <div class='account scroll'>
        <div class="<?php if ($addedAcount || $failuredAcount) echo $addedAcount ? "win_added_acc" : "fail_added_acc"; else echo 'hidden' ?>" >
            <div><?php echo $addedAcount ? "Cuenta agregada exitosamente" : "Error al agregar cuenta"; ?></div>
            <div>
                <a href="accounts.php?add">
                    <button class="accept"><?php echo $addedAcount ? "Nueva Cuenta" : "Aceptar" ?></button>
                </a>
            </div>
        </div>
        <article <?php echo $addedAcount || $failuredAcount ? "class='hidden'" : "class=''"; ?>>
            <div class="basic-info">
                <form id="form-add" action="accounts.php?add" method="POST">
                    <fieldset class="select_platform">
                        <legend>Plataforma</legend>
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
                    </fieldset>
                    <fieldset>
                        <legend>Datos de la cuenta</legend>
                        <div class="div_input">
                            <div>Nombre de la cuenta:</div>
                            <input type="text" name="name" id="name" class="required" placeholder="requerido (*)">
                            <div class="special_message">
                                <span class="text-error"></span>
                            </div>
                        </div>
                        <div id="acc_name_rep" class="hidden"></div>
                        <!-- CONTRASEÑA -->
                        <fieldset class="password">
                            <legend>Contraseña</legend>
                            <div class="div_input">
                                <div>Contraseña:</div>
                                <div class="div_pass">
                                    <div id="shps" class="eye">
                                        <input type="checkbox" name="shps">
                                    </div>
                                    <input type="password" name="pass" id="pass" class="required" placeholder="requerido (*)">
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
                                    <input type="password" name="pswd_rep" id="pass_rep" class="required" placeholder="requerido (*)">
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
                                    <div id="shurl" class="eye">
                                        <input type="checkbox" name="shurl">
                                    </div>
                                    <input type="text" name="url" id="url" placeholder="OPCIONAL">
                                </div>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Notas (Información visible):
                                </div>
                                <div class="div_pass">
                                    <div id="shnotes" class="eye">
                                        <input type="checkbox" name="shnotes">
                                    </div>
                                    <textarea name="notes" id="notes" placeholder="OPCIONAL" maxlength="255"></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char">0/255</span>
                            </div>
                            <div class="div_textarea">
                                <div>
                                    Información sensible (Información oculta):
                                </div>
                                <div class="div_pass">
                                    <div id="shinfo" class="eye">
                                        <input type="checkbox" name="shinfo">
                                    </div>
                                    <textarea name="info" id="info" placeholder="OPCIONAL" maxlength="255"></textarea>
                                </div>
                                <div></div>
                                <span class="display_textarea_char">0/255</span>
                            </div>
                        </fieldset>
                    </fieldset>
                    <div class="special_message">
                        <span class="dangerous"></span>
                    </div>
                    <input type="submit" name ="add_account" id="save" value="Guardar" class="accept">
                </form>
            </div>
        </article>
    </div>
</section>
