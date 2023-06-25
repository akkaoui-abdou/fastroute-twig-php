<?php


namespace App\Controller;


class LinksController
{
    /**
     * @var array
     */
    private $injection;

    public function __construct(array $injection)
    {
        $this->injection = $injection;
    }

    public function index()
    {
        $links = [];

        if (file_exists(__DIR__.'/../../var/links.txt')) {
            $file = fopen(__DIR__.'/../../var/links.txt', 'r');

            while (($buffer = fgets($file)) !== false) {
                $explode = explode('|', $buffer);
                $links[] = [
                    'name' => $explode[0],
                    'href' => $explode[1]
                ];
            }

            fclose($file);
        }

        echo $this->injection['template']->render('links.html',[
            'links' => $links
        ]);
    }

    public function add()
    {
        if (!empty($_POST)) {
            $this->addLink($_POST['name'], $_POST['link']);

            return header('Location: /list', true, 301);
        }

        echo $this->injection['template']->render('add_links.html');
    }

    public function addLink($name, $link)
    {
        $file = fopen(__DIR__.'/../../var/links.txt', 'a+');
        fwrite($file, $name.'|'.$link.PHP_EOL);
        fclose($file);
    }
}
