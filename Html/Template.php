<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response\Html;

use Eureka\Component\Response;
use Eureka\Component\Template\TemplateInterface;

/**
 * Class to manage HTML response with Template class.
 *
 * @author  Romain Cottard
 * @version 1.0.0
 */
class Template extends Html
{
    /**
     * Render content.
     *
     * @return $this
     * @throws \LogicException
     */
    public function renderContent()
    {
        if (!($this->content instanceof TemplateInterface)) {
            throw new \LogicException('Cannot render content: content not instance of "Template" class!');
        }

        return $this->content->render();
    }
}