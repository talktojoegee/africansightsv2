<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Slider extends Model
{
    use HasFactory;


    public function publishSlider(Request $request, $filename){
        $slider = new Slider();
        $slider->caption = $request->title ?? 'No title';
        $slider->link = $request->buttonLink ?? null;
        $slider->description = $request->description ?? null;
        $slider->attachment = $filename;
        $slider->status = $request->status ?? 1;
        $slider->save();
    }

    public function editSlider(Request $request, $filename){
        $slider =  Slider::find($request->sliderId);
        $slider->caption = $request->title ?? 'No title';
        $slider->link = $request->buttonLink ?? null;
        $slider->description = $request->description ?? null;
        $slider->attachment = $filename;
        $slider->status = $request->status ?? 1;
        $slider->save();
    }
}
