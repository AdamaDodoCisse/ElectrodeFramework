<?php

namespace ElectrodeFramework;


use Electrode\Injector\DIC;
use Electrode\Injector\FIC;
use Electrode\Navigator\Http\Route\Route;
use Electrode\Navigator\Http\Route\RouterReaderInterface;
use Symfony\Component\Yaml\Parser;

class FrameworkRouteReader implements RouterReaderInterface
{

    private static $instance;

    private $routes;

    /**
     * FrameworkRouteManager constructor.
     */
    private function __construct()
    {
        $this->routes = array();
    }

    /**
     * @return self
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Route []
     */
    public function getRoutes()
    {

        if (!empty($this->routes)) {
            return $this->routes;
        }

        $parser = new Parser();

        $routingImport = $parser->parse(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'routing.yml'));


        if (isset($routingImport['import']) && is_array($routingImport['import'])) {
            $dic = new DIC();
            foreach ($routingImport['import'] as $item) {
                $filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . $item;

                $routeConfiguration = $parser->parse(file_get_contents($filename));

                foreach ($routeConfiguration as $name => $configuration) {
                    $route = new Route($configuration['url']);
                    $route->setName($name);
                    $controller = $dic->getSingleton($configuration['callback']['controller']);
                    $action = $configuration['callback']['method'] . 'Action';

                    if (isset($configuration['requirements'])) {
                        foreach ($configuration['requirements'] as $key => $regex) {
                            $route->setPattern($key, $regex);
                        }
                    }

                    $route->setAction(function () use ($dic, $route, $controller, $action) {
                        $fic = new FIC($dic);
                        return $fic->execute([$controller, $action], $route->getParameters());
                    });

                    $this->routes[] = $route;
                }
            }
        }

        return $this->routes;
    }

    /**
     * @param $name
     * @return Route
     */
    public function getRouteByName($name)
    {
        return isset($this->getRoutes()[$name]) ? $this->getRoutes()[$name] : null;
    }
}