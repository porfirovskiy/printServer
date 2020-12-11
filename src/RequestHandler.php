<?php

namespace PrintServer;

/**
 * Class for proccessing requests from clients
 *
 * @author porfirovskiy
 */
class RequestHandler implements RequestHandlerInterface {
    
    protected string $path;
    protected string $time;
    protected string $message;
    protected \stdClass $paramsObject; /* create DTO for validator */
    protected Validator $validator;

    /**
     * 
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }
    
    /**
     * Check request proccessing result
     * 
     * @return bool
     */
    public function isSuccessfulProcessed(): bool
    {
        $this->setParams();
        $this->setParamsObject();
        
        if ($this->validator->validate($this->paramsObject)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Set DTO object for Validator
     * 
     * @return void
     */
    protected function setParamsObject(): void
    {
        $this->paramsObject = new \stdClass();
        $this->paramsObject->path = $this->path;
        $this->paramsObject->time = $this->time;
        $this->paramsObject->message = $this->message;
    }
    
    /**
     * Get params from GET request
     * 
     * @return array
     */
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
    
    /**
     * Set params from request params
     *  
     * @return void
     */
    protected function setParams(): void
    {
        $params = $this->getParamsFromRequest();

        $this->setPathParam($params['path']);
        $this->setTimeParam($params['time']);
        $this->setMessageParam($params['message']);
    }

    /**
     * Setter for time property
     * 
     * @param string $time
     * @return void
     */
    protected function setTimeParam(string $time): void
    {
        $this->time = $time;
    }
    
    /**
     * Setter for path property
     * 
     * @param string $path
     * @return void
     */
    protected function setPathParam(string $path): void
    {
        $this->path = $path;
    }
    
    /**
     * Setter for message property
     * 
     * @param string $message
     * @return void
     */
    protected function setMessageParam(string $message): void
    {
        $this->message = $message;
    }
    
    /**
     * Getter for time property
     * 
     * @return string
     */
    public function getTimeParam(): string
    {
        return $this->time;
    }
    
    /**
     * Getter for message property
     *  
     * @return string
     */
    public function getMessageParam(): string
    {
        return $this->message;
    }
    
}
