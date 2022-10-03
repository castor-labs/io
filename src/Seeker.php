<?php

declare(strict_types=1);

/**
 * @project Castor IO
 * @link https://github.com/castor-labs/io
 * @project castor/io
 * @author Matias Navarro-Carter mnavarrocarter@gmail.com
 * @license BSD-3-Clause
 * @copyright 2022 Castor Labs Ltd
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Castor\Io;

/**
 * Interface Seeker.
 */
interface Seeker
{
    public const START = 0;
    public const CURRENT = 1;
    public const END = 2;

    /**
     * Seeks a bytes source to an specific position.
     *
     * Calling seek with no arguments will return the current cursor position.
     *
     * @return int the new cursor position after the seek operation
     *
     * @throws Error if the seeking operation fails
     */
    public function seek(int $offset = 0, int $whence = self::CURRENT): int;
}
