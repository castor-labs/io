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
 * Class Buffer represents a read-write stream that can be stored in memory.
 *
 * It is useful when you need readers and writers for testing purposes.
 */
final class Buffer implements ReadSeeker, ReaderAt, WriteSeeker, WriterAt, WriterTo
{
    use ResourceHelper;

    /**
     * Buffer constructor.
     *
     * @param $resource
     */
    protected function __construct($resource)
    {
        $this->setResource($resource);
    }

    public function __destruct()
    {
        $this->innerClose();
    }

    /**
     * @throws Error
     */
    public function __toString(): string
    {
        $this->seek(0, Seeker::START);

        return readAll($this);
    }

    /**
     * Creates an in-memory buffer of bytes.
     *
     * The pointer of the buffer is located at the end of the string.
     *
     * @throws Error
     */
    public static function from(string $string): Buffer
    {
        $buffer = new self(fopen('php://memory', 'w+b'));
        $buffer->write($string);

        return $buffer;
    }

    /**
     * {@inheritDoc}
     */
    public function read(int $length): string
    {
        return $this->innerRead($length);
    }

    /**
     * {@inheritDoc}
     */
    public function readAt(int $offset, int $length): string
    {
        return $this->innerReadAt($offset, $length);
    }

    /**
     * {@inheritDoc}
     */
    public function seek(int $offset = 0, int $whence = Seeker::CURRENT): int
    {
        return $this->innerSeek($offset, $whence);
    }

    /**
     * {@inheritDoc}
     */
    public function write(string $bytes): int
    {
        return $this->innerWrite($bytes);
    }

    /**
     * @throws Error
     */
    public function writeTo(Writer $writer): int
    {
        return copy($this, $writer);
    }

    /**
     * {@inheritDoc}
     */
    public function writeAt(int $offset, string $bytes): int
    {
        return $this->innerWriteAt($offset, $bytes);
    }
}
