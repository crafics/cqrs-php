<?php
/*
 * This file is part of the Cqrs package.
 * (c) Manfred Weber <manfred.weber@gmail.com> and Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cqrs;

use Cqrs\Gate\GateException;
use Cqrs\Bus\BusInterface;
use Cqrs\Bus\SystemBus;
use Cqrs\Command\ClassMapCommandHandlerLoader;
use Cqrs\Event\ClassMapEventListenerLoader;

/**
 * Gate
 *
 * @author Manfred Weber <manfred.weber@gmail.com>
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class Gate {
    
    /**
     * Singleton instance
     * 
     * @var Gate
     */
    private static $instance;

    /**
     * Bus systems
     *
     * @var array
     */
    private $busSystems;
    
    /**
     * 
     * @return Gate
     */
    static public function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
            $systemBus = new SystemBus(
                new ClassMapCommandHandlerLoader(),
                new ClassMapEventListenerLoader()
            );
            static::$instance->pipe($systemBus);
        }
        
        return static::$instance;
    }

    /**
     * Private constructor
     */
    private function __construct(){
        $this->busSystems = array();
    }
    
    private function __clone()
    {
        //Singleton implementation, so clone is not allowed
    }

    public function pipe(BusInterface $bus){
        $bus->setGate($this);
        if( isset($this->busSystems[$bus->getName()]) ){
            switch( $bus->getName() ){
                case 'system-bus':
                    throw GateException::pipeError(sprintf('Bus <%s> is reserved!',$bus->getName()));
                default:
                    throw GateException::pipeError(sprintf('Bus <%s> is already piped!',$bus->getName()));
            }
        }
        $this->busSystems[$bus->getName()] = $bus;
    }

    /**
     * 
     * @param string $name
     * @return BusInterface
     * @throws \Exception
     */
    public function getBus($name){
        if(!isset($this->busSystems[$name])){
            throw GateException::busError(sprintf("Bus <%s> does not exists",$name));
        }
        return $this->busSystems[$name];
    }

}