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
 * Reads from a reader until EndOfFile is reached and puts all the contents into
 * memory.
 *
 * @psalm-param positive-int $chunk
 *
 * @throws Error
 */
function readAll(Reader $reader, int $chunk = 4096): string
{
    $contents = '';
    while (true) {
        try {
            $contents .= $reader->read($chunk);
        } catch (EndOfFile $e) {
            break;
        }
    }

    return $contents;
}

/**
 * Copies bytes from a reader to a writer.
 *
 * @psalm-param positive-int $chunk
 *
 * @return int The amount of bytes copied
 *
 * @throws Error
 */
function copy(Reader $reader, Writer $writer, int $chunk = 4096): int
{
    $copied = 0;
    while (true) {
        try {
            $bytes = $reader->read($chunk);
            $copied += $writer->write($bytes);
        } catch (EndOfFile $e) {
            break;
        }
    }

    return $copied;
}
