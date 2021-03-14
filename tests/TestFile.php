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
 * Class TestFile.
 */
class TestFile implements ReadWriteSeeker
{
    use ResourceHelper;

    /**
     * TestFile constructor.
     *
     * @param resource $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function read(int $length, string &$bytes): int
    {
        return $this->innerRead($length, $bytes);
    }

    public function seek(int $offset, int $whence): int
    {
        return $this->innerSeek($offset, $whence);
    }

    public function write(string $bytes): int
    {
        return $this->innerWrite($bytes);
    }
}
