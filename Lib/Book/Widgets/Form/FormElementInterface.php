<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.1 Form class


namespace Book\Widgets\Form;

interface FormElementInterface {
    public function setName($name);
    public function getName();
    public function setValue($value);
    public function getValue();
    public function show();
}