<?php

namespace Grocelivery\Geolocalizer\Exceptions;

use Exception;
use Grocelivery\Utils\Exceptions\ErrorRenderer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package Grocelivery\Geolocalizer\Exceptions
 */
class Handler extends ExceptionHandler
{
    /** @var ErrorRenderer */
    protected $errorRenderer;

    /** @var array */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];


    /**
     * Handler constructor.
     * @param ErrorRenderer $errorRenderer
     */
    public function __construct(ErrorRenderer $errorRenderer)
    {
        $this->errorRenderer = $errorRenderer;
    }

    /**
     * @param Exception $exception
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Exception $exception
     * @return mixed
     */
    public function render($request, Exception $exception)
    {
        $this->errorRenderer
            ->additionallyHandle(
                ModelNotFoundException::class,
                Response::HTTP_NOT_FOUND,
                'Not found.'
            );

        return $this->errorRenderer->render($request, $exception);
    }
}
