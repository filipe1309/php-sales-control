<?php
// 7 Creating an app
// 7.1 Application
// 7.1.1 Index
// 7.4.8 Login control
// 7.4.8.1 A new index



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

use Book\Session\Session;

// Read template content
$content = '';

new Session;

if (Session::getValue('logged')) {
    $template = file_get_contents('App/Templates/template.html');
    $class = '';
} else {
    $template = file_get_contents('App/Templates/login.html');
    $class = 'LoginForm';
}

if (isset($_GET['class']) && Session::getValue('logged')) {
    $class = $_GET['class'];
}

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


// Inject generated content inside the template
$output = str_replace('{content}', $content, $template);
$output = str_replace('{class}', $class, $output);

// show generated outputs
echo $output;
