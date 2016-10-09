<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response\Json;

/**
 * Class to manage response for API
 *
 * @author  Romain Cottard
 */
class Api extends Json
{
    /**
     * @var bool $isSuccess If request is a success or not.
     */
    private $isSuccess = true;

    /**
     * @var string $errorCode Error code if request is not a success.
     */
    private $errorCode = '';

    /**
     * @var string $errorMessage Error message if request is not a success.
     */
    private $errorMessage = '';

    /**
     * Over getContent response. Add specific content to the response.
     *
     * @return string
     */
    public function getContent()
    {
        $json = new \stdClass();

        $json->isSuccess    = $this->isSuccess();
        $json->errorCode    = $this->getErrorCode();
        $json->errorMessage = $this->getErrorMessage();
        $json->data         = $this->content;

        return $json;
    }

    /**
     * Get if request is a success or not.
     *
     * @return bool
     */
    final public function isSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * Set if request is a success.
     *
     * @param  boolean $isSuccess
     * @return self
     */
    final public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = (bool) $isSuccess;

        return $this;
    }

    /**
     * Get error code.
     *
     * @return string
     */
    final public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Set error code.
     *
     * @param  string $code
     * @return self
     */
    final public function setErrorCode($code)
    {
        $this->errorCode = (string) $code;

        return $this;
    }

    /**
     * Get error message.
     *
     * @return string
     */
    final public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set error message.
     *
     * @param  string $message
     * @return self
     * @throws \RuntimeException
     */
    final public function setErrorMessage($message)
    {
        $this->errorMessage = (string) $message;

        if (empty($this->errorMessage)) {
            throw new \RuntimeException('Error message cannot be empty !');
        }

        return $this;
    }

    /**
     * Append content for the response.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     * @throws \InvalidArgumentException
     */
    public function appendContent($key, $value)
    {
        if ($this->content === null) {
            $this->content = array();
        }

        if (!is_array($this->content)) {
            throw new \InvalidArgumentException('Cannot append response content: Current content is not an array !');
        }

        $this->content[(string) $key] = $value;

        return $this;
    }
}
