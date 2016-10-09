<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response;

/**
 * Factory for response instances.
 *
 * @author  Romain Cottard
 */
class Factory
{
    /**
     * @var string FORMAT_JSON Response in json.
     */
    const FORMAT_JSON = 'json';

    /**
     * @var string FORMAT_HTML Response in html.
     */
    const FORMAT_HTML = 'html';

    /**
     * @var string FORMAT_XML Response in xml.
     */
    const FORMAT_XML = 'xml';

    /**
     * @var string FORMAT_TEXT Response in text.
     */
    const FORMAT_TEXT = 'text';

    /**
     * @var string ENGINE_API API Engine to generate response.
     */
    const ENGINE_API = 'api';

    /**
     * @var string ENGINE_TEMPLATE Template Engine to generate response.
     */
    const ENGINE_TEMPLATE = 'template';

    /**
     * @var string ENGINE_NONE Empty engine to generate raw content in specified format (json, html...)
     */
    const ENGINE_NONE = '';

    /**
     * Create response object.
     *
     * @param  string $format
     * @param  string $engine
     * @return Response
     * @throws \DomainException
     */
    public static function create($format = self::FORMAT_JSON, $engine = self::ENGINE_API)
    {
        $response = '\Eureka\Component\Response';

        switch ($format) {
            //~ Json
            case self::FORMAT_JSON:
                $responseFormat = '\Json';
                break;
            //~ Html
            case self::FORMAT_HTML:
                $responseFormat = '\Html';
                break;
            //~ Other
            case self::FORMAT_XML:
            case self::FORMAT_TEXT:
            default:
                throw new \DomainException('Unsupported output format !');
        }

        switch ($engine) {
            //~ Api Engine
            case self::ENGINE_API:
                $response .= $responseFormat . '\Api';
                break;
            //~ Layout Engine
            case self::ENGINE_TEMPLATE:
                $response .= $responseFormat . '\Template';
                break;
            //~ None
            case self::ENGINE_NONE:
                $response .= $responseFormat . $responseFormat;
                //~ Do not add engine name to the class name.
                break;
            //~ Other
            default:
                throw new \DomainException('Unsupported output engine !');
        }

        $responseInstance = new $response();

        return $responseInstance;
    }
}