<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response\Header;

use Eureka\Component\Response\ResponseInterface;

/**
 * Header class to manage php header.
 * Implement response_interface to allow an instance of this class as a valid response.
 *
 * @author  Romain Cottard
 * @version 1.0.0
 */
class Header implements ResponseInterface
{

    /**
     * @var boolean $isReplace
     */
    private $isReplace = true;

    /**
     * @var integer $httpCode Http Code
     */
    private $httpCode = null;

    /**
     * @var string $content Header content text.
     */
    private $content = '';

    /**
     * response_header constructor.
     *
     * @param string  $content
     * @param boolean $isReplace
     * @param integer $httpCode
     */
    public function __construct($content, $isReplace = true, $httpCode = null)
    {
        $this->setContent($content);
        $this->setIsReplace($isReplace);
        $this->setHttpCode($httpCode);
    }

    /**
     * Send the header
     *
     * @return $this
     */
    public function send()
    {
        header($this->content, $this->isReplace, $this->httpCode);

        return $this;
    }

    /**
     * Set header content
     *
     * @param  string $content
     * @return $this
     * @throws \Exception
     */
    protected function setContent($content)
    {
        $this->content = (string) $content;

        if (empty($this->content)) {
            throw new \Exception('Header content is empty !');
        }

        return $this;
    }

    /**
     * Set is replace content in header if already exists.
     *
     * @param  boolean $isReplace
     * @return $this
     */
    protected function setIsReplace($isReplace)
    {
        $this->isReplace = (bool) $isReplace;

        return $this;
    }

    /**
     * Set http code for the header
     *
     * @param  integer $httpCode
     * @return $this
     * @throws \DomainException
     */
    protected function setHttpCode($httpCode = null)
    {
        if ($httpCode !== null) {
            $this->httpCode = (int) $httpCode;

            if (!HttpCode::exists($this->httpCode)) {
                throw new \DomainException('Http Code does not exist! (code: ' . $this->httpCode . ')');
            }
        }

        return $this;
    }
}