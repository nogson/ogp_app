<?php

namespace App\Http\Controllers;

use App\Models\Message;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageController extends Controller
{

    public function show($id)
    {
        $message = Message::find($id);
        return response() ->json([
           'message' => $message->content,
           'url' => config('app.image_url') . '/' . $message->file_path
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $image = explode(';', $params['image'])[1];
        $image = explode(',', $image)[1];
        $decodedImage = base64_decode($image);
        $content = $params['message'];

        $id = DB::transaction(function () use ($decodedImage, $content) {

            $id = Str::uuid();
            $file = $id->toString() . '.jpg';

            Message::create([
                'id' => $id,
                'content' => $content,
                'file_path' => $file,
            ]);

            $isSuccess = Storage::disk('s3')->put($file, $decodedImage);

            if (!$isSuccess) {
                throw new Exception('ファイルアップロード時にエラーが発生しました。');
            }

            Storage::disk('s3')->setVisibility($file, 'public');

            return $id;
        });


        return response()->json($id);
    }
}
