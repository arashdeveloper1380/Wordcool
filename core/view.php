<?php

namespace core;

include ARASH_DIR . 'app/inc/helpers.php';

use Exception;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;

class View
{
    private static $viewFactory;

    public static function render($view, $data = [])
    {
        $viewPath = ARASH_DIR . 'resources/' . str_replace('.', '/', $view) . '.php';

        if (file_exists($viewPath)) {
            if (isset($data) && is_array($data)) {
                extract($data);
            }
            require $viewPath;
        } else {
            throw new Exception('File not found: ' . $viewPath);
        }
    }

    public static function renderBlade($view, $data = [])
    {
        if (!isset(self::$viewFactory)) {
            $viewPaths = [ARASH_DIR . 'resources/views'];
            $fileSystem = new Filesystem;
            $viewFinder = new FileViewFinder($fileSystem, $viewPaths);
            $bladeCompiler = new BladeCompiler($fileSystem, ARASH_DIR . 'resources/cache/views');
            $resolver = new EngineResolver;
            $resolver->register('blade', function () use ($bladeCompiler) {
                return new CompilerEngine($bladeCompiler);
            });
            self::$viewFactory = new Factory($resolver, $viewFinder, new \Illuminate\Events\Dispatcher);
        }

        echo self::$viewFactory->make($view, $data)->render();
    }
}