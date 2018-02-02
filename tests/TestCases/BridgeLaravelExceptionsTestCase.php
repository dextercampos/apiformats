<?php
declare(strict_types=1);

namespace Tests\EoneoPay\ApiFormats\TestCases;

use EoneoPay\Utils\Interfaces\BaseExceptionInterface;
use PHPUnit\Framework\TestCase;

abstract class BridgeLaravelExceptionsTestCase extends TestCase
{
    /**
     * Process test for codes getters on BaseExceptionInterface implementations.
     *
     * @param \EoneoPay\Utils\Interfaces\BaseExceptionInterface $exception
     * @param int $errorCode
     * @param int $errorSubCode
     * @param int $statusCode
     */
    protected function processExceptionCodesTest(
        BaseExceptionInterface $exception,
        int $errorCode,
        int $errorSubCode,
        int $statusCode
    ): void {
        self::assertEquals($errorCode, $exception->getErrorCode());
        self::assertEquals($errorSubCode, $exception->getErrorSubCode());
        self::assertEquals($statusCode, $exception->getStatusCode());
    }
}