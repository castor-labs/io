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
 * Class TestReader.
 */
final class TestReader implements ReadSeeker
{
    use ResourceHelper;

    /**
     * TestReader constructor.
     *
     * @param resource $resource
     */
    public function __construct($resource)
    {
        $this->setResource($resource);
    }

    public static function fromString(string $string): TestReader
    {
        $stream = fopen('php://memory', 'r+b');
        fwrite($stream, $string);
        rewind($stream);

        return new self($stream);
    }

    public static function fromFile(string $filename): TestReader
    {
        $stream = fopen($filename, 'rb');

        return new self($stream);
    }

    /**
     * {@inheritDoc}
     */
    public function seek(int $offset, int $whence): int
    {
        return $this->innerSeek($offset, $whence);
    }

    /**
     * {@inheritDoc}
     */
    public function read(int $length, string &$bytes): int
    {
        return $this->innerRead($length, $bytes);
    }
}
