<section>
    <div class='panel-title'>
        <div></div>
        <h3>ELIMINAR</h3>
        <div></div>
    </div>
    <div class='account justify-content-center scroll'>
        <div class="fail_added_acc" >
            <div>Esta acción es irreversible. Si eliminas esta plataforma, las cuentas asociadas también serán eliminadas.</div>
            <div>¿Estás seguro de que quieres eliminar esta plataforma y todas las cuentas asociadas?</div>
            <div class="panel-dual_button">
                <a href="platforms.php">
                    <button class="cancel">No</button>
                </a>
                <form action="platforms.php?deleted" method="POST">
                    <input type="hidden" name="idPlatform" value="<?php echo $_GET['del'] ?>">
                    <button class="accept" name="delete_platform">Sí</button>
                </form>
            </div>
        </div>
    </div>
</section>