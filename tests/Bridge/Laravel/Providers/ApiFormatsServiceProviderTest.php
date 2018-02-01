<?php
declare(strict_types=1);

namespace Tests\EoneoPay\ApiFormats\Bridge\Laravel\Providers;

use EoneoPay\ApiFormats\Bridge\Laravel\Providers\ApiFormatsServiceProvider;
use EoneoPay\ApiFormats\External\Interfaces\Psr7FactoryInterface;
use EoneoPay\ApiFormats\External\Libraries\Psr7Factory;
use EoneoPay\ApiFormats\Interfaces\RequestEncoderGuesserInterface;
use EoneoPay\ApiFormats\RequestEncoderGuesser;
use Laravel\Lumen\Application;
use PHPUnit\Framework\TestCase;

class ApiFormatsServiceProviderTest extends TestCase
{
    /**
     * Provider should publish config on boot().
     */
    public function testBoot(): void
    {
        /** @noinspection PhpParamsInspection Related to Lumen design pattern */
        $serviceProvider = new ApiFormatsServiceProvider(new Application());
        $serviceProvider->boot();

        $publishes = $serviceProvider::$publishes;

        self::assertArrayHasKey(ApiFormatsServiceProvider::class, $publishes);
        self::assertArrayHasKey(ApiFormatsServiceProvider::CONFIG_PATH, $publishes[ApiFormatsServiceProvider::class]);
    }

    /**
     * Provider should register services on register().
     */
    public function testRegister(): void
    {
        $application = new Application();
        /** @noinspection PhpParamsInspection Related to Lumen design pattern */
        $serviceProvider = new ApiFormatsServiceProvider($application);
        $serviceProvider->register();

        self::assertInstanceOf(RequestEncoderGuesser::class, $application->get(RequestEncoderGuesserInterface::class));
        self::assertInstanceOf(Psr7Factory::class, $application->get(Psr7FactoryInterface::class));
    }
}