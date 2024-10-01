<?php

namespace App\Traits;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait UploadImageTrait
{
    public function uploadImage(
        NewsRequest $request,
        $inputName,
        $path
    )
    {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $extension = $image->getClientOriginalExtension();
            $day = date('d');
            $month = date('m');
            $year = date('Y');
            $imageName = uniqid().$day.'-'.$month.'-'.$year.'.'.$extension;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function updateImage(
        Request $request,
        $inputName,
        $path,
        $oldPath = null
    )
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $extension = $image->getClientOriginalExtension();
            $day = date('d');
            $month = date('m');
            $year = date('Y');
            $imageName = uniqid().$day.'-'.$month.'-'.$year.'.'.$extension;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
