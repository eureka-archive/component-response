<?php

/**
 * Copyright (c) 2010-2016 Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Component\Response;

/**
 * Interface response
 *
 * @author  Romain Cottard
 * @version 1.0.0
 */
interface ResponseInterface {

	/**
	 * Send headers & content
	 *
	 * @return $this
	 */
	public function send();

}