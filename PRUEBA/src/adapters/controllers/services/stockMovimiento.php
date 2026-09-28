<?php
require_once __DIR__ . '/ObtenerFactura.php';
require_once __DIR__ . '/EnvioFacturaDTO.php';

function main() {
    try {
        $factura = obtenerFactura();
        $envio = new EnvioFacturaDTO();
        $envio->enviarDatos($factura);
    } catch (\Throwable $error) {
        error_log($error->getMessage());
    }
}

main();