<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data = [], string|false $layout = 'template.twig'): void
    {
        // Рендерим внутренний шаблон и сохраняем HTML
        $inner = $this->twig->render($template . '.twig', $data);

        // Если указан шаблон-обёртка, выводим его,
        // иначе отдаём только внутреннее содержимое
        if ($layout === false) {
            echo $inner;
            return;
        }

        $this->twig->display($layout, [
            'content' => $inner,
            'title' => $data['title'] ?? null,
        ]);
    }
}