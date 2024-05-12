<section>
    <div class='panel-title'>
        <div></div>
        <h3>ELIMINAR</h3>
        <div></div>
    </div>
    <div class='account justify-content-center scroll'>
        <div class="fail_added_acc" >
            <div>Esta acción es irreversible. Si elimina este usuario, sus datos no podrán ser recuperados.</div>
            <div>¿Está seguro de que desea eliminar este usuario y todas sus cuentas y claves?</div>
            <div class="panel-dual_button">
                <a href="users.php">
                    <button class="cancel">No</button>
                </a>
                <form action="users.php?deleted" method="post">
                    <input type="hidden" name="idUser" value="<?php echo $_GET['del'] ?>">
                    <button class="accept" name="delete_user">Sí</button>
                </form>
            </div>
        </div>
    </div>
</section>