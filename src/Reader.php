<?php

declare(strict_types=1);

/**
 * @project Castor Io
 * @link https://github.com/castor-labs/io
 * @package castor/io
 * @author Matias Navarro-Carter mnavarrocarter@gmail.com
 * @license MIT
 * @copyright 2021 CastorLabs Ltd
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Castor\Io;

/**
 * A Reader reads some bytes from a source.
 */
interface Reader
{
    /**
     * Reads bytes from a source.
     *
     * Due to composed readers acting on the $bytes, `read` MAY
     * return less bytes than the actually requested.
     *
     * @param int $length The amount of bytes to be read
     *
     * @throws EndOfFile when the end of file is reached
     * @throws Error     when a reading error occurs
     *
     * @return string The bytes read
     */
    public function read(int $length): string;
}
