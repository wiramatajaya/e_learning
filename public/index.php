<?php
/**
 * Public Entry Point
 * Sistem Informasi E-Learning & Akademik Sekolah (MVC OOP)
 */

// Load Configuration & Helpers
require_once __DIR__ . '/../config/config.php';

// Load Core MVC Framework
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/App.php';

// Initialize and dispatch Application Router
$app = new App();
