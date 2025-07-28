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

    public function render(string $template, array $data = []): void
    {
        // Рендерим внутренний шаблон и сохраняем HTML
        $inner = $this->twig->render($template . '.twig', $data);

        // Выводим общий шаблон, передавая контент и заголовок страницы
        $this->twig->display('template.twig', [
            'content' => $inner,
            'title' => $data['title'] ?? null,
        ]);
    }
}