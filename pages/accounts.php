
<?php
    /**
     * @author Emmanuel Bailón
     */

    include "../config/db_config.php";
    include "../resource/functions.php";
    include "../class/DBAbstractModel.php";
    include "../class/Users.php";
    include "../class/Platforms.php";
    include "../class/Accounts.php";

    session_start();

    include '../controller/routes/users.php';   //Acceso solo para usuarios activados
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="author" content="Francisco Javier González Sabariego">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../img/favicon.ico">
        <script src="../js/functions.js"></script>
        <script src="../js/passManager.js"></script>
        <script src="../js/selects/select_categories.js"></script>
        <script src="../js/selects/select_platforms.js"></script>
        <script src="../js/accounts/add_account.js"></script>
        <script src="../js/accounts/delete_account.js"></script>
        <script src="../js/accounts/edit_account.js"></script>
        <script src="../js/accounts/view_account.js"></script>
        <title>KeysBank</title>
    </head>
    <body>
        <noscript><h1>Esta página requiere el uso de JavaScript</h1></noscript>
        <div>
            <header>
                <?php
                    include '../include/header.php';
                ?>
            </header>
            <main>
                <nav>
                    <?php
                        include "../include/nav.php";
                    ?>
                </nav>
                <div class="container">
                    <div class="name-page"><h2>CUENTAS</h2></div>
                    <?php
                        include "../controller/accounts_controller.php";
                    ?>
                </div>
            </main>
            <footer></footer>
        </div>
    </body>
</html>
<?php

class Accounts extends DBAbstractModel {

    private static $_instancia;

    public function __construct() {

    }
    
    public static function singleton() {
        if (!isset(self::$_instancia)) {
            $miClase = __CLASS__;
            self::$_instancia = new $miClase;
        }
        return self::$_instancia;
    }

    public function __clone() {
        trigger_error('La clonación no es permitida.', E_USER_ERROR);
    }

    /**
     * Devuelve el total de cuentas del usuario
     */
    public function getUserAccounts($idUser, $search = '') {
        if ($search == '' || $search == '*') {
            $this->query = "SELECT P.name, A.id,A.idCategory,C.category,A.idPlatform,AES_DECRYPT(UNHEX(A.name_account),K.password),DATEDIFF(CURDATE(), A.pass_date),AES_DECRYPT(UNHEX(A.notes),K.password)
            FROM keysbank_accounts A, keysbank_keys K, keysbank_platform_categories C, keysbank_platforms_list P
            WHERE K.idUser = A.idUser
            AND K.idCategory = A.idCategory
            AND C.id = A.idCategory
            AND A.idUser = :idUser
            AND P.id = A.idPlatform";
        }
        else {
            $this->query = "SELECT P.name, A.id,A.idCategory,C.category,A.idPlatform,AES_DECRYPT(UNHEX(A.name_account),K.password),DATEDIFF(CURDATE(), A.pass_date),AES_DECRYPT(UNHEX(A.notes),K.password) 
            FROM keysbank_accounts A, keysbank_keys K, keysbank_platform_categories C, keysbank_platforms_list P
            WHERE K.idUser = A.idUser
            AND K.idCategory = A.idCategory
            AND C.id = A.idCategory
            AND A.idUser = :idUser
            AND P.id = A.idPlatform
            AND lower(P.name) LIKE :search";
        }

        $this->parametros['idUser'] = $idUser;
        $this->parametros['search'] = '%'.$search.'%';

        $this->get_results_from_query();
        $this->close_connection();

        return $this->rows;
    }

    /**
     * Inserta una nueva cuenta
     * 
     * @param Array $data Conjunto de datos necesarios para insertar una nueva cuenta
     */
    public function addAccount($data = array()) {
        // Verificar si el campo name_account está presente y no es nulo
        if (!isset($data['name_account']) || $data['name_account'] === '') {
            // Si name_account está ausente o es nulo, lanzar una excepción o manejar el error según sea necesario
            throw new Exception('El campo name_account es requerido.');
        }

        // Consulta de inserción
        $this->query = "INSERT INTO keysbank_accounts 
        (idUser,idCategory,idPlatform,name_account,pass_account,pass_date,url,info,notes)
        VALUES
        (:idUser,
        :idCategory,
        :idPlatform,
        HEX(AES_ENCRYPT(:name_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
        HEX(AES_ENCRYPT(:pass_account,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
        :pass_date,
        HEX(AES_ENCRYPT(:url,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
        HEX(AES_ENCRYPT(:info,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))),
        HEX(AES_ENCRYPT(:notes,(SELECT password FROM keysbank_keys WHERE idUser = :idUser AND idCategory = :idCategory))) )";

        // Asignar parámetros
        $this->parametros['idUser']        = $data['idUser'];
        $this->parametros['idCategory']    = $data['idCategory'];
        $this->parametros['idPlatform']    = $data['idPlatform'];
        $this->parametros['name_account']  = $data['name_account'];
        $this->parametros['pass_account']  = $data['pass_account'];
        $this->parametros['pass_date']     = $data['pass_date'];
        $this->parametros['url']           = $data['url'];
        $this->parametros['info']          = $data['info'];
        $this->parametros['notes']         = $data['notes'];

        // Ejecutar la consulta
        $this->get_results_from_query();
        $this->close_connection();
    }

        /**
         * Borra una cuenta determinada pasándole por parámetros el id del usuario propietario y el id de la cuenta
         * 
         * @param Number $idUser ID del usuario propietario de la cuenta
         * @param Number $idAccount ID de la cuenta
         */
        public function deleteAccount($idUser,$idAccount) {
            $this->query = "DELETE FROM keysbank_accounts WHERE id = :id AND idUser = :idUser";

            $this->parametros['id']     = $idAccount;
            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Devuelve el ID de la categoría a la que pertecene la cuenta
         */
        public function getIdCategoryByAccount($idAccount) {
            $this->query = "SELECT idCategory FROM keysbank_accounts WHERE id = :id";

            $this->parametros['id'] = $idAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows[0]['idCategory'];
        }

        /**
         * Devuelve una lista de cuentas propietarias del usuario que repiten el mismo nombre de cuenta
         */
        public function getAccountsUserByNameRepeat($idUser,$nameAccount) {
            $this->query = "SELECT P.name, A.id, AES_DECRYPT(UNHEX(A.name_account),K.password)
                            FROM keysbank_accounts A, keysbank_keys K, keysbank_platforms_list P 
                            WHERE K.idUser = A.idUser 
                            AND K.idCategory = A.idCategory 
                            AND A.idUser = :idUser
                            AND P.id = A.idPlatform
                            AND LOWER(CONVERT(AES_DECRYPT(UNHEX(A.name_account),K.password) USING utf8)) = LOWER(:name_account)
                            ORDER BY P.name";

            $this->parametros['idUser']       = $idUser;
            $this->parametros['name_account'] = $nameAccount;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

    }
    
?>