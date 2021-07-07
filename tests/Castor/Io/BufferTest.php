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

use PHPUnit\Framework\TestCase;

/**
 * Class BufferTest.
 *
 * @internal
 * @coversNothing
 */
class BufferTest extends TestCase
{
    public function testReading(): void
    {
        $buffer = Buffer::from('Hello World!');

        $hello = $buffer->readAt(0, 5);
        self::assertSame('Hello', $hello);
    }
}
