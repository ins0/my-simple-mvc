<?php

namespace App\Controllers;

class FrontController
{
    const DEFAULT_CONTROLLER = "App\\Controllers\\RootController";
    const DEFAULT_ACTION = "get";

    protected $callable = [self::DEFAULT_CONTROLLER, self::DEFAULT_ACTION];
    protected $params = array();

    public function __construct(array $options = array())
    {
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["callable"])) {
                $this->setCallable($options["callable"]);
            }

            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    protected function parseUri()
    {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

        @list($controller, $action, $params) = explode("/", $path, 3);

        if (isset($controller) && isset($action)) {
            $this->setCallable(["App\\Controllers\\$controller", $action]);
        }

        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }

    public function setCallable(callable $callable)
    {
        if (!is_callable($callable)) {
            throw new InvalidArgumentException(
                "The callable has not been defined."
            );
        }
        $this->callable = $callable;

        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    public function run()
    {
        return call_user_func_array($this->callable, $this->params);
    }
}
