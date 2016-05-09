<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
    public function uploadImageMerchant()
    {
        if (Input::hasFile('imageMerchant')) {
            $file = Input::file('imageMerchant');
            $file->move('uploads', $file->getClientOriginalName());
            // echo '<img src="uploads/' . $file->getClientOriginalName() . '"/>';
        }
    }
}
