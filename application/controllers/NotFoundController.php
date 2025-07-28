<?php
class NotFoundController extends Controller
{
    public function action_index(): void
    {
        http_response_code(404);
        $this->view->render('404');
    }
}