<?php

/**
 * Clase Session
 * 
 * Gestiona el manejo de sesiones en PHP y el almacenamiento/recuperacion
 * de mensajes de notificacion flash de un solo uso entre redirecciones.
 */
class Session {
    /**
     * Inicializa la sesion de PHP si no se ha iniciado previamente
     */
    public static function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Establece un valor en la sesion
     * @param string $key Clave de sesion
     * @param mixed $value Valor a guardar
     */
    public static function set(string $key, $value): void {
        self::init();
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesion
     * @param string $key Clave de sesion
     * @param mixed $default Valor por defecto si no existe la clave
     * @return mixed
     */
    public static function get(string $key, $default = null) {
        self::init();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Guarda un mensaje flash en la sesion para la siguiente peticion HTTP
     * @param string $type Tipo de mensaje ('success', 'error', 'info', 'warning')
     * @param string $message Texto de la notificacion
     */
    public static function flash(string $type, string $message): void {
        self::init();
        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Obtiene todos los mensajes flash guardados y los limpia de la sesion
     * @return array Arreglo de mensajes flash acumulados
     */
    public static function getFlashes(): array {
        self::init();
        $flashes = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flashes;
    }
}
