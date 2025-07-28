<?php
class NotFoundController extends Controller
{
    public function action(string $viewName): void
    {
        http_response_code(404);
        $this->view->render('404');
    }
}