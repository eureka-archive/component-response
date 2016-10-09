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
     * @return self
     */
    abstract public function renderContent();

    /**
     * Send Headers & content
     *
     * @return self
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
     * @param  int $code
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    protected function sendContent()
    {
        echo $this->renderContent();

        return $this;
    }
}