<?php

namespace PrintServer;

/**
 * Description of RequestHandler
 *
 * @author porfirovskiy
 */
class RequestHandler implements RequestHandlerInterface {
    
    protected string $path;
    protected string $time;
    protected string $message;
    protected \stdClass $paramsObject; /* create DTO for validator */
    protected Validator $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }
    
    public function isSuccessfulProcessed(): bool
    {
        $this->setParams();
        $this->setParamsObject();
        
        if ($this->validator->validate($this->paramsObject)) {
            return true;
        }
        
        return false;
    }
    
    protected function setParamsObject(): void
    {
        $this->paramsObject = new \stdClass();
        $this->paramsObject->path = $this->path;
        $this->paramsObject->time = $this->time;
        $this->paramsObject->message = $this->message;
    }
    
    protected function getParamsFromRequest(): array
    {
        $url = $_SERVER[REQUEST_URI]; 
        $urlData = parse_url($url);
        
        parse_str($urlData['query'], $params);
        
        $path = isset($urlData['path']) ? $urlData['path'] : '';
        $time = isset($params['time']) ? htmlspecialchars($params['time']) : '';
        $message = isset($params['message']) ? htmlspecialchars($params['message']) : '';
        
        return [
            'path' => $path,
            'time' => $time,
            'message' => $message
        ];
    }
    
    protected function setParams(): void
    {
        $params = $this->getParamsFromRequest();

        $this->setPathParam($params['path']);
        $this->setTimeParam($params['time']);
        $this->setMessageParam($params['message']);
    }

    protected function setTimeParam(string $time): void
    {
        $this->time = $time;
    }
    
    protected function setPathParam(string $path): void
    {
        $this->path = $path;
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
