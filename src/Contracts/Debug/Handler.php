<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/23
 * Time: 下午1:13
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Debug;

use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;

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
     * @param  \Exception  $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        if ($this->exceptionHandler !== null) {
            $this->exceptionHandler->report($e);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \UnexpectedValueException
     */
    public function render($request, Exception $e)
    {
        $errors = [
            'message' => $e->getMessage(),
            'trace' => collect($e->getTrace())->map(function ($item) {
                return [
                    'file' => array_get($item, 'file'),
                    'line' => array_get($item, 'line'),
                    'method' => array_get($item, 'function'),
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
     * @param  \Exception $e
     * @return void
     */
    public function renderForConsole($output, Exception $e)
    {
        if ($this->exceptionHandler !== null) {
            $this->exceptionHandler->renderForConsole($output, $e);
        }
    }

    /**
     * Determine if the exception should be reported.
     *
     * @param \Exception $e
     *
     * @return bool
     */
    public function shouldReport(Exception $e)
    {
        return true;
    }
}
