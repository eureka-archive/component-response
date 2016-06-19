<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response\Json;

use Eureka\Component\Response\Response;
use Eureka\Component\Response\Header\Header;

/**
 * Class to manage response in json format
 *
 * @author  Romain Cottard
 * @version 1.0.0
 */
abstract class Json extends Response
{

    /**
     * @var integer $option Json encode options
     */
    private $option = 0;

    /**
     * @var integer $depth Json encode max depth
     */
    private $depth = 512;

    /**
     * response_json constructor.
     */
    public function __construct()
    {
        $this->addHeader(new Header('Content-type: application/json'));
    }

    /**
     * Encode content into json format.
     *
     * @return string
     * @throws \RuntimeException
     */
    public function renderContent()
    {
        $string = json_encode($this->getContent(), $this->option, $this->depth);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Json encode error ! (error: ' . json_last_error_msg() . ')');
        }

        echo $string;
    }

    /**
     * Json encode option (use json constants)
     *
     * @param  integer $option
     * @return $this
     */
    public function setOption($option = 0)
    {
        $this->option = (int) $option;

        return $this;
    }

    /**
     * Json encode max depth
     *
     * @param  integer $depth
     * @return $this
     */
    public function setDepth($depth = 512)
    {
        $this->depth = (int) $depth;

        return $this;
    }
}
