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

use InvalidArgumentException;

/**
 * Class ResourceHelper helps to implement some common I/O interfaces in the
 * context of a PHP resource.
 *
 * Methods are private because you must select what to expose and what to hide
 * in your own implementations.
 */
trait ResourceHelper
{
    /**
     * @var resource
     * @psalm-var resource|closed-resource
     */
    private $resource;

    private bool $closed = false;

    /**
     * @param resource $resource
     */
    private function setResource($resource): void
    {
        if (!is_resource($resource)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Argument 1 passed to %s must be a resource, %s given',
                    __METHOD__,
                    gettype($resource)
                )
            );
        }
        $this->resource = $resource;
    }

    /**
     * @throws Error
     * @throws EndOfFile
     */
    private function innerRead(int $length): string
    {
        if (true === $this->closed) {
            throw new Error('Could not read bytes: Underlying resource is closed.');
        }
        if (feof($this->resource)) {
            throw new EndOfFile('Could not read bytes: End of file reached');
        }
        $bytes = fread($this->resource, $length);
        if (!is_string($bytes)) {
            throw new Error('Could not read bytes: Unknown error.');
        }

        return $bytes;
    }

    /**
     * @throws Error
     * @throws EndOfFile
     */
    private function innerReadAt(int $offset, int $length): string
    {
        $this->innerSeek($offset, Seeker::START);

        return $this->innerRead($length);
    }

    /**
     * @throws Error
     */
    private function innerSeek(int $offset, int $whence): int
    {
        if (true === $this->closed) {
            throw new Error('Could not seek to offset: Underlying resource is closed.');
        }
        $int = fseek($this->resource, $offset, $whence);

        return $int;
    }

    /**
     * @throws Error
     */
    private function innerWrite(string $bytes): int
    {
        if (true === $this->closed) {
            throw new Error('Could not write bytes: Underlying resource is closed.');
        }
        $int = fwrite($this->resource, $bytes);
        if (!is_int($int)) {
            throw new Error('Could not write bytes: Unknown error.');
        }

        return $int;
    }

    /**
     * @throws Error
     */
    private function innerWriteAt(int $offset, string $bytes): int
    {
        $this->innerSeek($offset, Seeker::START);

        return $this->innerWrite($bytes);
    }

    private function innerClose(): void
    {
        fclose($this->resource);
        $this->resource = null;
        $this->closed = true;
    }
}
