<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UploadPhoto;
use App\Gallery;

class GalleryController extends Controller
{
    public function index ()
    {
        $photos = Gallery::select('id', 'name', 'description', 'photo')->skip(0)->take(30)->get();

        return view('panel.gallery', [
            'photos' => $photos,
            'page_name' => 'gallery'
        ]);
    }

    public function upload (UploadPhoto $req)
    {
        $name = substr(md5(time() . rand()), 0, 8);
        $imageName = $name . '.' . $req->photo->getClientOriginalExtension();
        $req->photo->move(public_path('uploads/'), $imageName);
        $req->photo = $imageName;

        $gallery = new Gallery();
        $gallery -> name = $req -> name;
        $gallery -> description = $req -> description;
        $gallery -> photo = $imageName;
        $gallery -> save();

        return redirect()->back()->with('message', 'تصویر '.$req->name.' با موفقیت آپلود شد .');
    }

    public function edit ($id)
    {
        $selected = Gallery::select('id', 'name', 'description', 'photo')->where('id', $id)->get();
        $photos = Gallery::select('id', 'name', 'description', 'photo')->skip(0)->take(30)->get();

        return view('panel.gallery', [
            'photos' => $photos,
            'selected' => $selected[0],
            'edit' => true,
            'page_name' => 'gallery'
        ]);
    }

    public function update (Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'nullable|min:6|max:30',
            'description' => 'nullable|max:255',
        ], [
            'name.min' => 'نام تصویر میبایست حداقل 6 کاراکتر باشد !',
            'name.max' => 'نام تصویر میبایست حداکثر 30 کاراکتر باشد !',
            'description.max' => 'توضیح تصویر میبایست حداکثر 255 کاراکتر باشد !',
        ])->validate();

        Gallery::where('id', $req->id)->update([
            'name' => $req->name,
            'description' => $req->description
        ]);
        return redirect()->back()->with('message', 'اطلاعات تصویر '.$req->title.' با موفقیت بروز رسانی شد .');
    }

    public function delete ($id, $title, $filename)
    {
        
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$filename);

        Gallery::destroy($id);
        return redirect()->back()->with('message', 'تصویر '.$title.' با موفقیت حذف شد .');
    }
}