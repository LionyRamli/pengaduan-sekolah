@extends('layouts.backend.master')

@section('content')

<div class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col bg-white border shadow-lg rounded-xl">
            <!-- Header -->
            <div class="bg-blue-500 border-b rounded-t-xl py-4 px-5">
                <p class="text-lg font-bold text-white">
                    Tambah Data Pengaduan
                </p>
            </div>

            <!-- Flash Message -->
            @if(Session::has('message'))
                <div class="bg-green-100 text-green-600 text-sm px-4 py-2">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('inputaspirasi.store') }}" method="post" class="p-6 space-y-6" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="nis" class="block font-medium text-gray-700">NIS:</label>
                    <input type="number"
                        id="nis" name="nis"
                        class="@error('nis') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan NIS">
                    @error('nis')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label for="kategori_id" class="block font-medium text-gray-700">Kategori:</label>
                    <select id="kategori_id" name="kategori_id" 
                        class="@error('kategori_id') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Kategori</option>
                        @foreach(App\Models\Kategori::all() as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->keterangan }}</option>
                        @endforeach

                    </select>
                    @error('kategori_id')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label for="lokasi" class="block font-medium text-gray-700">Lokasi:</label>
                    <textarea 
                        id="lokasi" name="lokasi"
                        class="@error('lokasi') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan lokasi"></textarea>
                    @error('lokasi')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block font-medium text-gray-700">Keterangan:</label>
                    <textarea 
                        id="keterangan" name="keterangan"
                        class="@error('keterangan') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan keterangan"></textarea>
                    @error('keterangan')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <div>
                    <label for="foto" class="block font-medium text-gray-700">Upload Foto:</label>
                    <input type="file" id="foto" name="foto" 
                        class="@error('foto') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    @error('foto')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button 
                        type="submit" 
                        class="py-2 px-6 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
