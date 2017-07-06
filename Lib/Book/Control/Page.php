<?php
// 5 MVC Pattern
// 5.4 Control Patterns
// 5.4.2 Front Controller
// 5.6 Creating components
// 5.6.1 HTML Elements


namespace Book\Control;

use Book\Widgets\Base\Element;

/**
 * Page controller
 */
class Page extends Element
{
    /**
     * Método construtor
     */
    public function __construct()
    {
        parent::__construct('div');
    }
    
    /**
     * Executa determinado método de acordo com os parâmetros recebidos
     */
    public function show()
    {
        if ($_GET)
        {
            $class  = isset($_GET['class'])  ? $_GET['class']  : NULL;
            $method = isset($_GET['method']) ? $_GET['method'] : NULL;
            
            if ($class)
            {
                $object = $class == get_class($this) ? $this : new $class;
                if (method_exists($object, $method))
                {
                    call_user_func(array($object, $method), $_GET);
                }
            }
        }
        
        parent::show();
    }
}