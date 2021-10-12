<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class OngkosController extends Controller
{
    public function index()
    {
        $district = District::all();
        return view('Ongkos', compact('district'));
    }
    public function edit($id)
    {
        $district = District::find($id);
        return view('ongkosedit', compact('district'));
    }

    public function update(Request $request, $id)
    {
        $district = District::find($id);
        $district->update([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return redirect(route('ongkos.index'))->with(['success' => 'Ongkos Kirim Diperbaharui!']);
    }
   public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
       
        return redirect(route('ongkos.index'));
    }
}