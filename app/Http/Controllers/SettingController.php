<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    use AttachFilesTrait;
    public function index() {
    
    $setting = Setting::pluck('value', 'key')->all();

    return $setting;

    // return view('setting.index', compact('setting'));
}

    public function update(Request $request){

        try {

            $Info = $request->except('_token', '_method', 'logo');

            foreach($Info as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }

            if($request->hasFile('logo')) {

                $file_Name = $request->file('logo')->getClientOriginalName();

                Setting::where('key', 'logo')->update(['value' => $file_Name]);

                $this->UploadFile($request,'logo');

                toastr()->success(trans('messages.Update'));
                return back();

            }

        } catch(Exception $error) {
                return redirect()->back()->with(['error' => $error->getMessage()]);
        }

    }

    
}
