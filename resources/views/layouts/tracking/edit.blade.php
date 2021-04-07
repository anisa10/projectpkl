@extends('layouts.master')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <p>Data Kasus</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tracking.update', $tracking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                @livewire('tracking-data', ['selectedRw' => $tracking->id_rw, 'selectedKelurahan' => $tracking->rw->id_kelurahan,
                                                'selectedKecamatan' => $tracking->rw->kelurahan->id_kecamatan,
                                                'selectedKota' => $tracking->rw->kelurahan->kecamatan->id_kota,
                                                'selectedProvinsi' => $tracking->rw->kelurahan->kecamatan->kota->id_provinsi])
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Positif</label>
                                    <input type="text" min="1" name="positif" value="{{$tracking->positif}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Sembuh</label>
                                    <input type="text" min="1" max="positif" name="sembuh" value="{{$tracking->sembuh}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Meninggal</label>
                                    <input type="text" min="1" max="positif" name="meninggal" value="{{$tracking->meninggal}}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{$tracking->tanggal}}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href=" {{ route('tracking.index') }} " class="float-right btn btn-danger">Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
