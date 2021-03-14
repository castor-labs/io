<?php

declare(strict_types=1);

/**
 * @project Castor Io
 * @link https://github.com/castor-labs/io
 * @package castor/io
 * @author Matias Navarro-Carter mnavarrocarter@gmail.com
 * @license MIT
 * @copyright 2021 CastorLabs Ltd
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
     * @throws Error
     *
     * @return int The new offset
     */
    public function seek(int $offset, int $whence): int;
}
