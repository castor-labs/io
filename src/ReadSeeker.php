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
 * Interface ReadSeeker composes a Reader and a Seeker.
 */
interface ReadSeeker extends Reader, Seeker
{
}
