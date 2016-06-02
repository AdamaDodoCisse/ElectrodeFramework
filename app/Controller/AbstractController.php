<?php

namespace ElectrodeFramework\Controller;

use Electrode\VS\VS;

class AbstractController
{

    public function renderString($view, array $parameters = array())
    {
        $filename = str_replace([':', '/', '\\'], DIRECTORY_SEPARATOR, $view);

        if (strpos($filename, '.php') === false) {
            $filename .= '.php';
        }
        
        $filename = $this->getViewsDirectory() . DIRECTORY_SEPARATOR . $filename;
        $vs = new VS($filename, $parameters);
        return $vs->renderString();
    }

    public function render($view, array $parameters = array())
    {
        echo $this->renderString($view, $parameters);
    }

    protected function getViewsDirectory()
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Views';
    }
}