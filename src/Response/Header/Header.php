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
 */
class Header implements ResponseInterface
{
    /**
     * @var bool $isReplace
     */
    private $isReplace = true;

    /**
     * @var int $httpCode Http Code
     */
    private $httpCode = null;

    /**
     * @var string $content Header content text.
     */
    private $content = '';

    /**
     * Class constructor.
     *
     * @param string $content
     * @param bool   $isReplace
     * @param int    $httpCode
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
     * @return self
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
     * @return self
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
     * @param  bool $isReplace
     * @return self
     */
    protected function setIsReplace($isReplace)
    {
        $this->isReplace = (bool) $isReplace;

        return $this;
    }

    /**
     * Set http code for the header
     *
     * @param  int $httpCode
     * @return self
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