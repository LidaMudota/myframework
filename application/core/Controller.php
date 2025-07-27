<?php
class Controller
{
    protected View $view;
    protected ?Model $model = null;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action(string $viewName): void
    {
        $data = [];
        if ($this->model !== null) {
            $data = $this->model->data();
        }
        $this->view->render($viewName, $data);
    }
}