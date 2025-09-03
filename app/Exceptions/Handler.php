<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * Исключения, которые не нужно логировать.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Поля, которые не нужно сохранять при ошибках валидации.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Регистрация обработчиков исключений.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Можно логировать или игнорировать
        });
    }

    /**
     * Глобальный рендер исключений.
     */
   /* public function render($request, Throwable $exception)
    {
        // Логируем для отладки
        Log::error('Exception intercepted: ' . $exception->getMessage());

        // Если это уже 403 — вернуть как есть
        if ($exception instanceof HttpException && $exception->getStatusCode() === 403) {
            return parent::render($request, $exception);
        }

        // Любой другой exception — превращаем в 403
        return response()->view('errors.403', [], 403);
    }*/
}