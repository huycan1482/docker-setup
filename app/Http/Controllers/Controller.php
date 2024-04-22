<?php

namespace App\Http\Controllers;

use App\Service\ImageBBService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $imageBBService;

    public function __construct(ImageBBService $imageBBService) 
    {
        $this->imageBBService = $imageBBService;
    }

    public function upload (Request $request)
    {
        $encode = base64_encode(file_get_contents($request->file('image')));
        $res = $this->imageBBService->sendImage($encode);
        if ($res['success']) {
            $image = $res['data']['display_url'];
        }
        dd($res, $image);
    }

    public function testUpload () 
    {
        return view('admin.upload');
    }
}
