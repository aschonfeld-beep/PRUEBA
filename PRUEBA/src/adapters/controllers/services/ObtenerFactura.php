<?php

function obtenerFactura() {
    try {
        $ch = curl_init('https://localhost:3000/api/obtenerFactura');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // validar si la respuesta fue exitosa
        if ($httpCode !== 200 || $respuesta === false) {
            throw new \Exception('Error al obtener la factura');
        }

        $datos = json_decode($respuesta, true);
        echo print_r($datos, true);
        return $datos;

    } catch (\Throwable $error) {
        error_log($error->getMessage());
        return null;
    }
}