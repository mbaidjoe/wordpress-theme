<?php

namespace SymfonyTheme\Controllers;

use SymfonyTheme\Views\HtmlView;

class ErrorController
{
    /**
     * Array with http codes.
     *
     * @var array
     */
    private $httpCodes = [
        400 => 'Bad Request',
        404 => 'Not Found',
    ];

    /**
     * Renders the error template. The methods should be called as 'render4**'.
     *
     * @param  string $method
     * @param  array  $arguments
     * @return string
     */
    public function __call($method, array $arguments = [])
    {
        $code = (int) preg_replace('/^render([0-9]+)$/', '$1', $method);

        if (array_key_exists($code, $this->httpCodes)) {
            header('HTTP/1.1 ' . $code . ' ' . $this->httpCodes[$code]);
        }

        return (new HtmlView())->renderPage('/error');
    }
}
