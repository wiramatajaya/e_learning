<?php
/**
 * App Router
 * Parses URLs and dispatches requests to appropriate Controller & Method
 */

class App {
    protected string $controllerName = 'AuthController';
    protected $controller = null;
    protected string $method = 'index';
    protected array $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Default routing for root "/"
        if (empty($url) || empty($url[0])) {
            if (isLoggedIn()) {
                $role = getRole();
                redirect($role . '/dashboard');
                return;
            } else {
                $url = ['auth', 'login'];
            }
        }

        // 1. Controller detection
        $targetController = ucfirst(strtolower($url[0])) . 'Controller';
        $controllerFile = __DIR__ . '/../controllers/' . $targetController . '.php';

        if (file_exists($controllerFile)) {
            $this->controllerName = $targetController;
            unset($url[0]);
        } else {
            // Check if 404
            $this->render404("Halaman atau modul '{$url[0]}' tidak ditemukan.");
            return;
        }

        require_once $controllerFile;
        $this->controller = new $this->controllerName();

        // 2. Method detection
        if (isset($url[1])) {
            $methodName = $url[1];
            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                unset($url[1]);
            } else {
                $this->render404("Aksi '{$methodName}' tidak ditemukan pada modul ini.");
                return;
            }
        }

        // 3. Parameters
        $this->params = $url ? array_values($url) : [];

        // 4. Dispatch
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse requested URL from query string, PATH_INFO, or REQUEST_URI
     */
    protected function parseUrl(): array {
        if (!empty($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        if (!empty($_SERVER['PATH_INFO'])) {
            return explode('/', filter_var(trim($_SERVER['PATH_INFO'], '/'), FILTER_SANITIZE_URL));
        }

        // Extract from REQUEST_URI
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = str_replace('\\', '/', $uri);

            // Strip script dir / project root from URI
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            if ($scriptDir !== '/' && strpos($uri, $scriptDir) === 0) {
                $uri = substr($uri, strlen($scriptDir));
            }

            // Also check project folder name like /e_learn
            if (strpos($uri, '/e_learn') === 0) {
                $uri = substr($uri, 8);
            }

            // Remove /public if at start
            if (strpos($uri, '/public') === 0) {
                $uri = substr($uri, 7);
            }

            // Remove /index.php if at start
            if (strpos($uri, '/index.php') === 0) {
                $uri = substr($uri, 10);
            }

            $trimmed = trim($uri, '/');
            if ($trimmed !== '') {
                return explode('/', filter_var($trimmed, FILTER_SANITIZE_URL));
            }
        }

        return [];
    }

    protected function render404(string $message = 'Halaman tidak ditemukan'): void {
        http_response_code(404);
        $file = __DIR__ . '/../views/errors/404.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "<h1>404 - Not Found</h1><p>{$message}</p><p><a href='" . url() . "'>Kembali ke Beranda</a></p>";
        }
        exit;
    }
}
