<?php

class Servidor {
    private int $port = 3000;

    public function __construct() {
        // PHP no tiene un equivalente directo a app.listen() de Express:
        // no hay proceso persistente escuchando dentro del script.
        // Se ejecuta con el servidor embebido de PHP, que ya escucha el puerto:
        //   php -S localhost:3000 Server.php
        echo "Servidor PHP escuchando en el puerto {$this->port}" . PHP_EOL;
    }
}

new Servidor();