<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Tests\Fixtures\Controller;

class NullableController
{
    public function action(string $foo = null, ?\stdClass $bar, string $baz = 'value', $mandatory)
    {
    }
}
