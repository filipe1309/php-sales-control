<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.8  Actions


namespace Book\Control;

interface ActionInterface {

    public function setParameter($param, $value);
    public function serialize();
}