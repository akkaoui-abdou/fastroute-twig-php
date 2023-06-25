<?php


namespace App\Controller;


class IndexController
{
    private $injection = [];

    public function __construct(array $injection)
    {
        $this->injection = $injection;
    }

    public function index()
    {
        echo $this->injection['template']->render('index.html');
    }
}
