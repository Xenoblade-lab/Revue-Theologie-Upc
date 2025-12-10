<?php
namespace Controllers;

use Models\Database;

class Controller
{
    protected function matcherString(string $string, $match): bool
    {
        return preg_match($match, $string) ? true : false;
    }

    protected function valideLength(string $string, int $min = 6, int $max = 64): bool
    {
        return (strlen($string) >= $min && strlen($string) <= $max) ? true : false;
    }

    public function isNotEmpty($data): bool
    {
        return !empty($data) ? true : false;
    }

    public function isEmailValid($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function isPasswordValid(string $password): bool
    {
        return $this->valideLength($password, 8) && $this->matcherString($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/") ? true : false;
    }

    public function verifyFields(array $datas, array $fields): bool
    {
        foreach ($fields as $field) {
            if (!isset($datas[$field]) || empty($datas[$field])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Récupère une connexion PDO initialisée.
     */
    protected function db(): Database
    {
        $db = new Database();
        $db->connect();
        return $db;
    }

    /**
     * Lit les données envoyées (JSON ou formulaire classique).
     */
    protected function input(): array
    {
        $json = json_decode(file_get_contents('php://input'), true);
        return is_array($json) ? $json : ($_POST ?? []);
    }

    /**
     * Répond en JSON avec code HTTP.
     */
    protected function respond($payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($payload);
    }
}
?>