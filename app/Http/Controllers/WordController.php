<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WordController extends Controller
{
    public function getIndex()
    {
        $word = Word::ShowList()->get();
        return view('word.index')->with('word',$word);
    }

    //添加词库
    public function postAdd(Request $request)
    {

        $words = explode("\r\n",$request->input('word'));

        foreach($words as $key =>$val){
            $val = trim($val);
            if($val!=''){
                $qt = Word::where('name',$val)->first();
                if(!$qt){
                    Word::insert([
                        'name'=>$val,
                        'time'=>date('Y-m-d H:i:s')
                    ]);
                }
            }

        }

        return redirect()->back();

    }

}
