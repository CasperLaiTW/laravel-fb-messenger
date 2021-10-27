<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/23
 * Time: 下午1:13
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Debug;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler implements ExceptionHandler
{
    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;
    /**
     * @var Debug
     */
    private $debug;

    /**
     * Handler constructor.
     * @param ExceptionHandler $exceptionHandler
     * @param Debug $debug
     */
    public function __construct(ExceptionHandler $exceptionHandler, Debug $debug)
    {
        $this->exceptionHandler = $exceptionHandler;
        $this->debug = $debug;
    }

    /**
     * Report or log an exception.
     *
     * @param Throwable $e
     *
     * @return void
     * @throws Throwable
     */
    public function report(Throwable $e)
    {
        if ($this->exceptionHandler !== null) {
            $this->exceptionHandler->report($e);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \UnexpectedValueException
     */
    public function render($request, Throwable $e)
    {
        $errors = [
            'message' => $e->getMessage(),
            'trace' => collect($e->getTrace())->map(function ($item) {
                return [
                    'file' => Arr::get($item, 'file'),
                    'line' => Arr::get($item, 'line'),
                    'method' => Arr::get($item, 'function'),
                ];
            })->toArray(),
        ];
        $this->debug->setError($errors)->broadcast();

        return $this->exceptionHandler->render($request, $e);
    }

    /**
     * Render an exception to the console.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @param  Throwable $e
     * @return void
     */
    public function renderForConsole($output, Throwable $e)
    {
        if ($this->exceptionHandler !== null) {
            $this->exceptionHandler->renderForConsole($output, $e);
        }
    }

    /**
     * Determine if the exception should be reported.
     *
     * @param Throwable $e
     *
     * @return bool
     */
    public function shouldReport(Throwable $e)
    {
        return true;
    }
}
