<?php
/*
 * This file is part of the Cqrs package.
 * (c) Manfred Weber <crafics@php.net> and Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Malocher\Test\Coverage\Mock\Bus;

use Malocher\Cqrs\Bus\AbstractBus;

/**
 * Class MockBus
 *
 * @author Manfred Weber <crafics@php.net>
 * @package Malocher\Test\Coverage\Mock\Bus
 */
class MockBus extends AbstractBus
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'test-coverage-mock-bus';
    }
}
