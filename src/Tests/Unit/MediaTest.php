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

use Illuminate\Support\Facades\Storage;
use Dply\CMS\Models\User;
use Dply\CMS\Support\FileManager;
use Dply\Tests\TestCase;

class MediaTest extends TestCase
{
    public function testUploadByPath()
    {
        Storage::put('tmps/test.gif', base64_decode('R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='));

        $media = FileManager::addFile(
            Storage::path('tmps/test.gif'),
            'file',
            null,
            User::first()->id
        );

        $this->assertNotEmpty($media->path);

        $this->assertFileDoesNotExist(Storage::path('tmps/test.gif'));
    }

    public function testUploadByUrl()
    {
        $img = 'https://cdn.juzaweb.com/jw-styles/juzaweb/images/thumb-default.png';

        $media = FileManager::addFile($img, 'image', null, User::first()->id);

        $this->assertNotEmpty($media->path);

        $this->assertFileExists(
            Storage::disk('public')->path($media->path)
        );
    }
}
