@extends('layouts.backend.master')

@section('content')

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                    <p class="mt-3 text-lg text-gray-700 font-semibold dark:text-neutral-500">
                        Detail Aspirasi
                    </p>
                </div>
                <div class="mt-3 px-5">
                    <a href="{{ route('inputaspirasi.index') }}">
                        <button class="p-2 text-sm font-semibold rounded-md border border-green-600 bg-green-500 text-white hover:bg-blue-700 transition duration-150">
                            Daftar Aspirasi
                        </button>
                    </a>
                </div>
                @if(Session::has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded-md m-4">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @else
                    <p class="p-2 ml-4 text-sm mt-3 text-gray-500 dark:text-neutral-500">
                        Session message not set
                    </p>
                @endif

                <div class="p-4 md:p-5">
                    <div class="overflow-x-auto">
                        NIS: <b>{{$aspirasi->nis}}</b><br>
                        Kategori Pengaduan: <b>{{$aspirasi->kategori->keterangan}}</b><br>
                        Lokasi Pengaduan: <b>{{$aspirasi->lokasi}}</b><br>
                        Keterangan Pengaduan: <b>{{$aspirasi->keterangan}}</b><br>
                        Foto Pengaduan: <b><br><img src="{{ asset('foto/' . $aspirasi->foto) }}" class="w-20 h-20 object-cover rounded-md" alt="Foto"></b><br>
                        Status Pengaduan: 
                        @if (empty(App\Models\Aspirasi::where('input_aspirasi_id', $aspirasi->id)->latest()->first()->status))
                            <b>Menunggu</b>
                        @else
                            <b>{{ App\Models\Aspirasi::where('input_aspirasi_id', $aspirasi->id)->latest()->first()->status }}</b>
                        @endif
                        <br>
                        
                        <div class="form-group">
                            History Aspirasi: <br>
                            @foreach(App\Models\Aspirasi::where('input_aspirasi_id',$aspirasi->id)->get() as $aspirasi)
                            <b>{{$aspirasi->created_at}} - (($aspirasi->feedback))</b><br>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <a href="{{route('aspirasi.show', [$aspirasi->id] )}}"><button
                            class="btn btn-primary">Beri Tanggapan Aspirasi</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
