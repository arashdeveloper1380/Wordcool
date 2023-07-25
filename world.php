<?php

require_once __DIR__ . '/vendor/autoload.php';

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

        if($this->command === 'make:model'){

            $namespace = 'app\Models';
            $class = ucwords($this->parameter);
            $filename = $class . '.php';

            $context = "<?php
namespace $namespace;

use Illuminate\Database\Eloquent\Model;

class $class extends Model
{
    //
} ";
            $path = __DIR__ . "/app/Models/" . $filename;

            $fp = fopen($path,"w");
            fwrite($fp,$context);
            fclose($fp);
            echo "\n\n";
            if($fp)
                echo "[*] " . $filename . " Created Successful!\n\n";
        }

        if($this->command === 'make:migration'){
            $class = $this->parameter;
            $tableUp = ucwords($this->parameter);
            $CreateTable = "Create{$tableUp}Table";
            $table_name = "wp_{$class}";
            $filename = "create_{$class}_table.php";
            $table= '$table';

            $context = "<?php

require_once ARASH_DIR . 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class $CreateTable extends Migration
{
    public function up()
    {
        Capsule::schema()->create('$table_name', function ($table)  {
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('$table_name');
    }
} ";
            $path = __DIR__ . "/database/migrations/" . $filename;

            $fp = fopen($path,"w");
            fwrite($fp,$context);
            fclose($fp);
            echo "\n\n";
            if($fp)
                echo "[*] " . $filename . " Created Successful!\n\n";
        }

        if($this->command === 'migration'){

            $table_name = "create_" . $this->parameter . "_table.php";
            $table_name_exist =__DIR__ . "/database/migrations/" . $table_name;
            if(file_exists($table_name_exist)){
                $table_class = ucfirst($this->parameter);
                $table_class = "Create{$table_class}Table";

                include $table_name_exist;

                (new $table_class())->up();
            }else{
                echo "not found migration file";
            }
        }
    }
}

$app = new WorldCommand($argv);
$app->run();