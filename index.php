<?php
// 7 Creating an app
// 7.1 Application
// 7.1.1 Index


// Library Loader
require_once 'Lib/Book/Core/ClassLoader.php';
$libLoader = new Book\Core\ClassLoader;
$libLoader->addNamespace('Book', 'Lib/Book');
$libLoader->register();

// Application Loader
require_once 'Lib/Book/Core/AppLoader.php';
$appLoader = new Book\Core\AppLoader;
$appLoader->addDirectory('App/Control');
$appLoader->addDirectory('App/Model');
$appLoader->register();

// Read template content
$template = file_get_contents('App/Templates/template.html');
$content = '';
$class = 'Home';

if ($_GET) {
    $class = $_GET['class'];
    if (class_exists($class)) {
        try {
            $page = new $class; // instance class
            ob_start(); // start output control
            $page->show();
            $content = ob_get_contents(); // read output created
            ob_end_clean(); // finish output control
        } catch (Exception $e) {
            $content = $e->getMessage() . '<br>' . $e->getTraceAsString();
        }
    }
}

// Inject generated content inside the template
$output = str_replace('{content}', $content, $template);
$output = str_replace('{class}', $class, $output);

// show generated outputs
echo $output;
