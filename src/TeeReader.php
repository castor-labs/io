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
 * A TeeReader is a Reader that writes to the passed writer whatever is read
 * from the passed reader.
 */
final class TeeReader implements Reader
{
    private Reader $reader;
    private Writer $writer;

    /**
     * TeeReader constructor.
     */
    public function __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function read(int $length): string
    {
        $bytes = $this->reader->read($length);
        $this->writer->write($bytes);

        return $bytes;
    }
}
