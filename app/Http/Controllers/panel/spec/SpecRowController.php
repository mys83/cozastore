<?php

namespace App\Http\Controllers\panel\spec;

use App\Models\Spec\SpecRow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Spec\SpecHeader;

class SpecRowController extends Controller
{
    /**
     * Display a listing of the specification table rows.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function index(SpecHeader $header)
    {
        return view('panel.spec.row', [
            'header' => $header,
            'rows' => $header->specRows()->get(),
            'page_name' => 'specification',
            'page_title' => "سطر های عنوان {$header->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     * 
     * public function create(SpecHeader $header)
     * {
     *    //
     * }
     */

    /**
     * Store a newly created specification table row in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\SpecHeader  $header
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SpecHeader $header)
    {
        $header->specRows()->create(array_merge($request->all(), [
            'values' => explode(',', $request->values),
        ]));
        return redirect()->back()->with('message', "سطر {$request->title} برای عنوان 
                    {$header->title} با موفقیت ثبت شد");
    }

    /**
     * Display the specified specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $specRow
     * @return \Illuminate\Http\Response
     * 
     * public function show(SpecHeader $header, SpecRow $specRow)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified specification table row.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $row
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecHeader $header, SpecRow $row)
    {
        return view('panel.spec.row', [
            'header' => $header,
            'rows' => $header->specRows()->get(),
            'row' => $row,
            'page_name' => 'specification',
            'page_title' => "سطر های عنوان {$header->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified specification table row in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $row
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecHeader $header, SpecRow $row)
    {
        $row->update(array_merge($request->all(), [
            'values' => explode(',', $request->values),
        ]));
        return redirect()->back()->with('message', "سطر {$row->title} در عنوان 
                    {$header->title} با موفقیت بروزرسانی شد");
    }

    /**
     * Remove the specified specification table row from storage.
     *
     * @param  \App\models\spec\SpecHeader  $header
     * @param  \App\models\spec\SpecRow  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecHeader $header, SpecRow $row)
    {
        $row->delete();
        return redirect()->back()->with('message', "سطر {$row->title} در عنوان 
                    {$header->title} با موفقیت حذف شد");
    }
}
