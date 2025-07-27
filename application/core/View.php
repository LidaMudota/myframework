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
        $content = $this->twig->render($template . '.twig', $data);
        echo $this->twig->render('template.twig', ['content' => $content] + $data);
    }
}