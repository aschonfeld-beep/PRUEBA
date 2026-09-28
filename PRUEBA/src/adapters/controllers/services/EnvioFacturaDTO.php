<?php

class EnvioFacturaDTO {

    public function enviarDatos($factura = []) {
        $datos = [
            'factura' => $factura,
            'remitente' => ['id' => 1]
        ];

        $statusCode = null;

        try {
            $ch = curl_init('http://localhost:3000/api/factura');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
            curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

        } catch (\Throwable $error) {
            error_log($error->getMessage());
        }

        // condiciones
        if ($statusCode === 200) {
            echo "Factura enviada correctamente\n";
        } else {
            echo "Error al enviar la factura\n";
        }
    }
}