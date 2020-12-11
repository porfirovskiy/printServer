<?php

namespace PrintServer;

/**
 *
 * @author porfirovskiy
 */
interface RequestHandlerInterface 
{
    public function isSuccessfulProcessed(): bool;
    public function getTimeParam(): string;
    public function getMessageParam(): string;
}
