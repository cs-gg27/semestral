<?php
class Conecta {
    private $servername = "172.0.158.101";
    private $username = "cleidys";
    private $password = "Sydnelg27";
    private $dbname = "semestral_dweb";  

    private $cnn;

    public function conectarDB() {
        // Inicializar la conexión
        $this->cnn = mysqli_init();
        
        // Configurar SSL: asegúrate de tener los archivos de certificado correctos
        mysqli_ssl_set($this->cnn, NULL, NULL, '/path/to/ca-cert.pem', NULL, NULL);

        // Conectar con SSL
        mysqli_real_connect(
            $this->cnn,
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname,
            3306, 
            NULL,
            MYSQLI_CLIENT_SSL
        );

        // Verificar si hubo un error en la conexión
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
