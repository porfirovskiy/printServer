<?php

namespace PrintServer;

/**
 * Class for validating params form request
 *
 * @author porfirovskiy
 */
class Validator {
    
    const PATH_URL = '/printMeAt';
    const DATE_FORMAT = 'Y-m-d H:i:s';
    
    protected \stdClass $params;
    
    /**
     * Main validation method
     * 
     * @param \stdClass $params
     * @return bool
     */
    public function validate(\stdClass $params): bool
    {
        $this->setParams($params);
        
        if ($this->isNotEmptyParams()) {
            if ($this->validateParams()) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Setter for params property
     * 
     * @param \stdClass $params
     * @return void
     */
    protected function setParams(\stdClass $params): void
    {
        $this->params = $params;
    }
    
    /**
     * Validate 2 params(time, path)
     * 
     * @return bool
     */
    protected function validateParams(): bool 
    {
        if ($this->isValidPathParam()) {
            if ($this->isValidTimeParam()) {
                return true;
            }
        } 
        
        return false;
    }
    
    /**
     * Check all params on empty
     * 
     * @return bool
     */
    protected function isNotEmptyParams(): bool 
    {
        if (!empty($this->params->time) && !empty($this->params->message) && !empty($this->params->path)) {
            return true;
        }
        
        return false;
    }

    /**
     * Validating path param
     * 
     * @return bool
     */
    protected function isValidPathParam(): bool 
    {
        if ($this->params->path == static::PATH_URL) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Validating time param
     * 
     * @return bool
     */
    protected function isValidTimeParam(): bool 
    {
        $dateParam = date_create($this->params->time);
        $dateFormated = date_format($dateParam, static::DATE_FORMAT);
        
        if ($this->params->time == $dateFormated) {
            return true;
        }
        
        return false;
    }
    
}
