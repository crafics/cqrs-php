<?php
/*
 * This file is part of the Cqrs package.
 * (c) Manfred Weber <crafics@php.net> and Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Test\Coverage\Cqrs\Query;

use Cqrs\Query\ClassMapQueryHandlerLoader;
use Test\TestCase;

/**
 * Class ClassMapQueryHandlerLoaderTest
 *
 * @author Manfred Weber <crafics@php.net>
 * @package Test\Cqrs\Query
 */
class ClassMapQueryHandlerLoaderTest extends TestCase implements QueryHandlerLoaderInterfaceTest
{
    /**
     * @var ClassMapQueryHandlerLoader
     */
    protected $loader;

    public function setUp()
    {
        $this->loader = new ClassMapQueryHandlerLoader();
    }

    public function testConstructed()
    {
        $this->assertInstanceOf('Cqrs\Query\ClassMapQueryHandlerLoader', $this->loader);
    }

    public function testGetExistingQueryHandler()
    {
        $alias = 'Test\Coverage\Mock\Query\MockQuery';
        $listener = $this->loader->getQueryHandler($alias);
        $this->assertInstanceOf('Test\Coverage\Mock\Query\MockQuery', $listener);
    }

    public function testGetNonExistingQueryHandler()
    {
        $this->setExpectedException('Cqrs\Query\QueryException');
        $alias = 'Test\Coverage\Mock\Query\NotExisting_MockQuery';
        $this->loader->getQueryHandler($alias);
    }
}
