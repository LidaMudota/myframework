<?php

class ServicesController extends Controller
{
    public function action_index()
    {
        $this->view->render('services', [
            'title' => 'Услуги',
            'services' => [
                'Разработка сайтов',
                'Адаптивная вёрстка',
                'Интеграция с шаблонами',
                'Создание фреймворков'
            ]
        ]);
    }
}
