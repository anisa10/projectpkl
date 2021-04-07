<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Rw;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    
    public function index()
    {
        $tracking = Tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('layouts.tracking.index',compact('tracking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rw = Rw::all();
        return view('layouts.tracking.create',compact('rw'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_rw' => 'required',
            'positif' => 'required|min:1',
            'meninggal' => 'required|min:1',
            'sembuh' => 'required|min:1',
            // 'meninggal' => 'required|min:positif|max:positif',
            // 'sembuh' => 'required|min:positif|max:positif',
        ],[
            'id_rw.required' => 'Rw is required',
            'positif.required' => 'Jumlah Positif is required',
            'positif.min' => 'Jumlah Positif tidak boleh minus',
            'meninggal.required' => 'Jumlah Meninggal required',
            'meninggal.min' => 'Jumlah meninggal tidak boleh minus',
            'sembuh.required' => 'Jumlah Sembuh required',
            'sembuh.min' => 'Jumlah Sembuh tidak boleh minus',
            'meninggal.required' => 'Jumlah Meninggal required',
            'meninggal.min' => 'Jumlah Meninggal tidak boleh melebihi Positif.',
            'sembuh.required' => 'Jumlah Sembuh required',
            'sembuh.min' => 'Jumlah Sembuh tidak boleh melebihi Positif.',
        ]);
        
        $tracking = new Tracking;
        $tracking->id_rw = $request->id_rw;
        $tracking->positif = $request->positif;
        $tracking->sembuh = $request->sembuh;
        $tracking->meninggal = $request->meninggal;
        $tracking->tanggal = $request->tanggal;
        $tracking->save();
        return redirect()->route('tracking.index')
        ->with(['message'=>'Data Berhasil Dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('layouts.tracking.show',compact('tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('layouts.tracking.edit',compact('tracking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->id_rw = $request->id_rw;
        $tracking->positif = $request->positif;
        $tracking->sembuh = $request->sembuh;
        $tracking->meninggal = $request->meninggal;
        $tracking->tanggal = $request->tanggal;
        $tracking->save();
        return redirect()->route('tracking.index')
        ->with(['message'=>'Data Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id)->delete();
        return redirect()->route('tracking.index')
                        ->with(['message1'=>'Data Berhasil Dihapus']);
    }
}
