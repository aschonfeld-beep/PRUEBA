<?php
require_once __DIR__ . '/stockMovimiento.php';

/**
 * Equivalente a recibirVenta(req, res) de Express.
 * En PHP puro no hay objetos req/res: leemos el body JSON de la petición
 * y respondemos directo con http_response_code() + echo.
 */
function recibirVenta() {
    $datosVenta = json_decode(file_get_contents('php://input'), true);

    // validacion basica
    if (empty($datosVenta['ventaId']) || empty($datosVenta['productos'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Datos de venta invalidos o incompletos']);
        return;
    }

    try {
        // Pasamos el trabajo al servicio
        $resultadoERP = procesarVentaYActualizarStock($datosVenta);

        // Respondemos con éxito al Sistema A
        http_response_code(200);
        echo json_encode([
            'mensaje' => 'Venta procesada y stock actualizado correctamente',
            'sistemaBResponse' => $resultadoERP
        ]);

    } catch (\Throwable $error) {
        error_log('Error al procesar la integración: ' . $error->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Error interno en la integración de stock']);
    }
}

// Si este archivo es el entrypoint HTTP, ejecutar directamente:
if (php_sapi_name() !== 'cli') {
    recibirVenta();
}