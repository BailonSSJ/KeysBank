<section class="<?php echo $edited_successfully ? '' : 'hidden'; ?>">
    <div class="panel-title">
        <div></div>
        <h3>EDITADO</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <div class="win_added_acc">
            <div>Tu perfil ha sido editado</div>
            <div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <button class="accept">Aceptar</button>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="<?php echo $edited_successfully ? 'hidden' : ''; ?>">
    <div class="panel-title">
        <div></div>
        <h3>EDITAR</h3>
        <div></div>
    </div>
    <div class="result scroll">
        <form class="perfil-info" action="<?php echo $_SERVER['PHP_SELF'].'?edit'; ?>" method="POST">
            <div class="perfil-data">
                <h3>Datos de usuario</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Nick: </div>
                        <input type="text" name="nick" id="nick" class="<?php echo ($userExistException ? 'input-error' : ''); ?>" value="<?php echo ( $new_data_edit ? $_POST['nick'] : $_SESSION['user']['nick'] ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Nombre: </div>
                        <input type="text" name="name" id="name" value="<?php echo ( $new_data_edit ? $_POST['name'] : replaceCharacterByOtherCharacter( $_SESSION['user']['name'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ) ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Apellido: </div>
                        <input type="text" name="surname" id="surname" value="<?php echo ( $new_data_edit ? $_POST['surname'] : replaceCharacterByOtherCharacter( $_SESSION['user']['surname'], array("\\s","\\'",'\\"',"\\&","\\|","\\<","\\>"), array(" ","'",'"',"&","|","<",">") ) ); ?>">
                    </div>
                    <div class="col2">
                        <div class="bold">Email: </div>
                        <input type="mail" name="email" id="email" class="<?php echo ($mailFormatException || $mailExistException ? 'input-error' : ''); ?>" value="<?php echo ( $new_data_edit ? $_POST['email'] : $_SESSION['user']['email'] ); ?>">
                    </div>
                    <div class="col2">
                        <div><a href="<?php echo $_SERVER['PHP_SELF'].'?edit_password' ?>"><div class="div-copy_button">Editar contraseña</div></a></div>
                        <div id="password"><?php echo replaceByCharacter($_SESSION['user']['pass'],'*'); ?></div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <div class="special_message">
                        <span id="password_strength"></span>
                    </div>
                </div>
                <hr>
                <h3>Configuración de la aplicación</h3>
                <div class="container-data">
                    <div class="col2">
                        <div class="bold">Notificar contraseña antigua: </div> <div><input type="number" name="days_old_password" id="days_old_password" value="<?php echo ( $new_data_edit ? $_POST['days_old_password'] : $_SESSION['user']['days_old_password'] ); ?>"> días</div>
                    </div>
                </div>
                <div class="<?php echo ($userExistException || $mailFormatException || $mailExistException ? 'alert' : '');  ?>">
                    <?php 
                        if ($userExistException)
                            echo 'El nick no está disponible';
                        elseif ($mailFormatException)
                            echo 'Error de formato de email';
                        elseif ($mailExistException)
                            echo 'Este email ya ha sido registrado';
                    ?>
                </div>
            </div>
            <div class="panel-dual_button">
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>"><div class="div-cancel_button">Cancelar</div></a>
                <a href="<?php echo $_SERVER['PHP_SELF'].'?edit'; ?>"><button class="accept" name="update_profile">Aceptar</button></a>
            </div>
        </form>
    </div>
</section>