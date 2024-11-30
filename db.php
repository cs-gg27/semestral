<?php
class Conecta {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "semestral_dweb";  // Cambié el nombre de la base de datos

    private $cnn;

    public function conectarDB() {
        $this->cnn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->cnn->connect_error) {
            die("Conexión fallida: " . $this->cnn->connect_error);
        }
        return $this->cnn;
    }

    public function cerrar() {
        $this->cnn->close();
    }
}
?>
