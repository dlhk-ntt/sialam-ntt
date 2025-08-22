<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtilityController extends Controller
{
    public function removeTempFiles($target) {
        try {
            if (is_dir($target)) {
                $files = glob($target.'/*');
                foreach ($files as $f) {
                    $this->removeTempFiles($f);
                }
                rmdir($target);
            } else if (is_file($target)) {
                unlink($target);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
