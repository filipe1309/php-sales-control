<?php
// 5 MVC Pattern
// 5.3 SPL Autoloaders
// 5.3.2 Application Loader


namespace Book\Core;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class AppLoader
{
    protected $directories;
    
    /**
     * Adiciona um diretório a ser vasculhado
     */
    public function addDirectory($directory)
    {
        $this->directories[] = $directory;
    }
    
    /**
     * Registra o AppLoader
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }
    
    /**
     * Carrega uma classe
     */
    public function loadClass($class)
    {
        $folders = $this->directories;
        
        foreach ($folders as $folder)
        {
            if (file_exists("{$folder}/{$class}.php"))
            {
                require_once "{$folder}/{$class}.php";
                return TRUE;
            }
            else
            {
                if (file_exists($folder))
                {
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder),
                                                           RecursiveIteratorIterator::SELF_FIRST) as $entry)
                    {
                        if (is_dir($entry))
                        {
                            if (file_exists("{$entry}/{$class}.php"))
                            {
                                require_once "{$entry}/{$class}.php";
                                return TRUE;
                            }
                        }
                    }
                }
            }
        }
    }
}


/*
// index ex
require_once 'Lib/Book/Core/AppLoader.php';
$al = new Lib\Core\AppLoader;
$al->addDirectory('App/Control');
$al->addDirectory('App/Model');
$al->register();
*/