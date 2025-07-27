<?php
class AboutController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AboutModel();
    }
}