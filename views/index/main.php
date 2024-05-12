<section class="<?php echo $edited_successfully ? 'hidden' : ''; ?>">
    <div class="index-message scroll">
        <h2>Bienvenido <?php echo $_SESSION['user']['nick'] ?></h2>
        <h4>Has iniciado sesión con <?php echo strtolower($_SESSION['user']['perfil']) ?> perfil</h4>
        <?php
            if ($_SESSION['user']['perfil'] == 'ADMIN')
                include 'admin_message.php';
            elseif ($_SESSION['user']['perfil'] == 'USER')
                include 'user_message.php';
        ?>
    </div>
</section>