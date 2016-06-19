<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response;

use Eureka\Component\Response\Header;

/**
 * Response abstract class
 *
 * @author  Romain Cottard
 * @version 1.0.0
 */
abstract class Response implements ResponseInterface
{
    /**
     * @var Header\Header[] $headers List of headers for the response.
     */
    private $headers = array();

    /**
     * @var mixed $content Response content.
     */
    protected $content = null;

    /**
     * Send Headers & content
     *
     * @return $this
     */
    abstract public function renderContent();

    /**
     * Send Headers & content
     *
     * @return $this
     */
    final public function send()
    {
        $this->sendHeaders();
        $this->sendContent();

        return $this;
    }

    /**
     * Set Http Code (200, 301, 404...)
     *
     * @param  integer $code
     * @return $this
     * @throws \DomainException
     */
    public function setHttpCode($code)
    {
        $this->addHeader(new Header\Header('HTTP/1.1 ' . (int) $code . ' ' . Header\HttpCode::getText($code), true, (int) $code));

        return $this;
    }

    /**
     * Add header to the response.
     *
     * @param  Header\Header
     * @return $this
     */
    public function addHeader(Header\Header $header)
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * Get response headers.
     *
     * @return Header\Header[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set response content.
     *
     * @param  mixed $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Return response content.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Send response headers.
     *
     * @return $this
     */
    protected function sendHeaders()
    {
        foreach ($this->headers as $header) {
            $header->send();
        }

        return $this;
    }

    /**
     * Send content.
     *
     * @return $this
     */
    protected function sendContent()
    {
        echo $this->renderContent();

        return $this;
    }

}