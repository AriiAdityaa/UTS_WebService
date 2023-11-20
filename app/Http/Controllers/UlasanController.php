<?php 

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UlasanController extends Controller{
    public function index(Request $request)
    {
         $acceptHeader = $request->header('Accept');

        if($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
            $ulasan = Ulasan::OrderBy("id", "DESC")->paginate(2);

            if($acceptHeader == 'application/json' || $acceptHeader == 'application/xml'){
                return response()->json($ulasan->items('data'), 200);
                
            }else{
                $xml = new \SimpleXMLElement('<ulasan/>');
                foreach ($ulasan->items('data') as $item){
                $xmlitem->addChild('id', $item->id);
                $xmlitem->addChild('merk', $item->merk);
                $xmlitem->addChild('nama_pengulas', $item->nama_pengulas);
                $xmlitem->addChild('rating', $item->rating);
                $xmlitem->addChild('ulasan', $item->ulasan);
                }
                return $xml->asXML();
            }
    }else{
        return response('Not Acceptable', 406);
    }
}

public function show(Request $request, $id)
{
    $acceptHeader = $request->header('Accept');

    if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
        $contentTypeHeader = $request->header('Content-Type');

        if ($contentTypeHeader === 'application/json') {
            $ulasan = Ulasan::find($id);

            if (!$ulasan) {
                abort(404);
            }

            return response()->json($ulasan, 200);
        } else {
            return response('Tipe Media Tidak Mendukung!', 415);
        }
    } else {
        return response('Tidak Bisa Diterima!', 406);
    }
}

public function update(Request $request, $id)
{
    $input = $request->all();

    $ulasan = Ulasan::find($id);

    if (!$ulasan) {
        abort(404);
    }

    $validationRules = [
        'merk' => 'required',
        'nama_pengulas' => 'required',
        'rating' => 'required',
        'ulasan' => 'required',
    ];

    $validator = Validator::make($input, $validationRules);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $ulasan->fill($input);
    $ulasan->save();

    return response()->json($ulasan, 200);
}

public function store(Request $request){
    $input = $request->all();
    $ulasan = Ulasan::create($input);

    return response()->json($ulasan, 200);
}


public function destroy(Request $request, $id)
{
    $acceptHeader = $request->header('Accept');

    if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml') {
        $contentTypeHeader = $request->header('Content-Type');

        if ($contentTypeHeader === 'application/json' || 'application/xml') {
            $ulasan = Ulasan::find($id);

            if (!$ulasan) {
                abort(404);
            }

            $ulasan->delete();
            $message = ['message' => 'delete data berhasil'];

            return response()->json($message, 200);
        } else {
            return response('Tipe Media Tidak Mendukung!', 415);
        }
    } else {
        return response('Tidak Bisa Diterima!', 406);
    }
}
}