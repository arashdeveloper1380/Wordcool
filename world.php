<?php

class WorldCommand {
    private $command;
    private $parameter;

    public function __construct($argv) {
        $this->command = $argv[1];
        $this->parameter = $argv[2];
    }

    public function run() {
        if ($this->command === 'make:controller') {
            $namespace = 'Controllers';
            $class = ucwords($this->parameter) . 'Controller';
            $filename = $class . '.php';

            $context = "<?php
namespace $namespace;
include ARASH_DIR . 'init.php';
use app\Controllers\Controller;


class $class extends Controller
{


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store()
    {
        //
    }


    public function show()
    {
        //
    }


    public function edit()
    {
        //
    }


    public function update()
    {
        //
    }


    public function destroy()
    {
        //
    }
} ";
            $path = __DIR__ . "/app/Controllers/" . $filename;

            $fp = fopen($path,"w");
            fwrite($fp,$context);
            fclose($fp);
            echo "\n\n";
            if($fp)
                echo "[*] " . $filename . " Created Successful!\n\n";
        }
    }
}

$app = new WorldCommand($argv);
$app->run();