<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com/cms
 * @license    GNU V2
 */

namespace Dply\Tests\Unit;

use Dply\Tests\TestCase;

class OptimizeTest extends TestCase
{
    public function testOptimize()
    {
        $this->artisan('optimize')
            ->assertExitCode(0);
    }

    public function testOptimizeClear()
    {
        $this->artisan('optimize:clear')
            ->assertExitCode(0);
    }
}
