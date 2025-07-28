<?php
class ErrorHandler
{
    private string $logDir;
    private View $view;

    public function __construct(string $logDir)
    {
        $this->logDir = rtrim($logDir, '/');
        $this->view = new View();
    }

    public function register(): void
    {
        set_error_handler([$this, 'handleError']);
        set_exception_handler([$this, 'handleException']);
    }

    public function handleError($errno, $errstr, $errfile, $errline): void
    {
        $this->log("Error: [$errno] $errstr in $errfile on line $errline");
        $this->display(500);
    }

    public function handleException($exception): void
    {
        $this->log('Exception: ' . $exception->getMessage());
        $code = $exception->getCode();
        $this->display($code >= 400 && $code < 600 ? $code : 500);
    }

    private function log(string $message): void
    {
        $file = $this->logDir . '/error.log';
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
        $date = date('Y-m-d H:i:s');
        file_put_contents($file, "[$date] $message\n", FILE_APPEND);
    }

    private function display(int $code): void
    {
        http_response_code($code);
        $template = $code === 404 ? '404' : '500';
        $this->view->render($template);
    }
}