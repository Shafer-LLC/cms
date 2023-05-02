<?php

namespace Dply\Backend\Http\Controllers\FileManager;

use Illuminate\Http\Request;
use Dply\Backend\Models\MediaFile;
use Dply\Backend\Models\MediaFolder;

class DeleteController extends FileManagerController
{
    public function delete(Request $request)
    {
        $itemNames = $request->post('items');
        $errors = [];

        foreach ($itemNames as $file) {
            if (is_null($file)) {
                array_push($errors, parent::error('folder-name'));
                continue;
            }

            $is_directory = $this->isDirectory($file);
            if ($is_directory) {
                MediaFolder::find($file)->deleteFolder();
            } else {
                $file_path = $this->getPath($file);
                MediaFile::where('path', '=', $file_path)
                    ->first()
                    ->delete();
            }
        }

        if (count($errors) > 0) {
            return $errors;
        }

        return parent::$success_response;
    }
}
