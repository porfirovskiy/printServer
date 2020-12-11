<?php

namespace PrintServer;

/**
 * Description of RequestHandler
 *
 * @author porfirovskiy
 */
class RequestHandler implements RequestHandlerInterface {
    
    protected string $time;
    protected string $message;
    
    public function processing(): void
    {
        $this->setParams();
        if ($this->validParams()) {
            echo 'ok :)';
        } else {
            echo 'no ok!';
        }
    }
    
    protected function getParamsFromRequest(): array
    {
        $time = isset($_GET['time']) ? htmlspecialchars($_GET['time']) : '';
        $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
        
        return [
            'time' => $time,
            'message' => $message
        ];
    }
    
    protected function setParams(): void
    {
        $params = $this->getParamsFromRequest();
        echo '<pre>';var_dump($params);
        
        $this->setTimeParam($params['time']);
        $this->setMessageParam($params['message']);
    }

    protected function validParams(): bool
    {        
        if (empty($this->time) || empty($this->message)) {
            return false;
        }
        
        return true;
    }
    
    protected function setTimeParam(string $time): void
    {
        $this->time = $time;
    }
    
    protected function setMessageParam(string $message): void
    {
        $this->message = $message;
    }
    
    public function getTimeParam(): string
    {
        return $this->time;
    }
    
    public function getMessageParam(): string
    {
        return $this->message;
    }
}
