<?php

namespace PrintServer;

/**
 *
 * @author porfirovskiy
 */
interface RequestHandlerInterface {
    
    public function getParamsFromRequest(): array;
    public function setParams(): void;
    public function validParams(): bool;
    
}
