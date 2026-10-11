<?php
/**
 * Base Controller
 * Abstract class providing core MVC services to child controllers
 */

abstract class Controller {
    /**
     * Load a model instance
     */
    public function model(string $modelName) {
        $file = __DIR__ . '/../models/' . $modelName . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $modelName();
        }
        throw new Exception("Model '{$modelName}' not found.");
    }

    /**
     * Render a view file with provided data
     */
    public function view(string $viewPath, array $data = []): void {
        // Extract data into local variables for view
        extract($data);

        $file = __DIR__ . '/../views/' . $viewPath . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new Exception("View '{$viewPath}' not found.");
        }
    }

    /**
     * Output JSON response (for AJAX or API calls)
     */
    public function json(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    /**
     * Redirect to relative route
     */
    public function redirect(string $path): void {
        redirect($path);
    }
}
