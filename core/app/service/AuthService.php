<?php
namespace App\Service;

/**
 * Clase AuthService
 * 
 * Capa de servicio encargada de la logica de autenticacion,
 * inicio de sesion, verificacion de credenciales y cierre de sesion.
 */
class AuthService {
    /**
     * Procesa el intento de inicio de sesion de un usuario
     * @param string $username Nombre de usuario o correo electronico
     * @param string $password Contrasena en texto plano
     * @return bool True si las credenciales son validas, False en caso contrario
     */
    public function login(string $username, string $password): bool {
        $encryptedPass = sha1(md5($password));
        
        $user = \UserData::getLogin($username, $encryptedPass);
        
        if ($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            return true;
        }
        
        return false;
    }

    /**
     * Cierra la sesion activa destruyendo los datos guardados
     */
    public function logout(): void {
        session_destroy();
    }

    /**
     * Verifica si existe un usuario autenticado en la sesion actual
     * @return bool
     */
    public static function check(): bool {
        return isset($_SESSION['user_id']);
    }
}
