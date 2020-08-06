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
        return response()->json([
            'message' => $message->content,
            'name' => $message->name,
            'url' => config('app.image_url') . '/' . $message->file_path
        ]);
    }

    public function index(Request $request)
    {

        $offset = $request->offset ?: 0;
        $limit = $request->limit ?: 40;

        $messages = Message::orderBy('created_at', 'desc')->offset($offset)->limit($limit)->get()->map(function($item) {
            $msg['id'] =$item->id;
            $msg['message'] = $item->content;
            $msg['name'] = $item->name;
            $msg['url'] = config('app.image_url') . '/' . $item->file_path;
            return $msg;
        });

        return $messages;
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $image = explode(';', $params['image'])[1];
        $image = explode(',', $image)[1];
        $decodedImage = base64_decode($image);
        $content = $params['message'];
        $name = $params['name'];

        $id = DB::transaction(function () use ($decodedImage, $content, $name) {

            $id = Str::uuid();
            $file = $id->toString() . '.jpg';

            Message::create([
                'id' => $id,
                'content' => $content,
                'name' => $name,
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
