@extends('layouts.backend.master')

@section('content')

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col bg-white border shadow-lg rounded-xl">
            <!-- Header -->
            <div class="bg-blue-500 border-b rounded-t-xl py-4 px-5">
                <p class="text-lg font-bold text-white">
                    Tambah Data SIswa
                </p>
            </div>
            
            <!-- Flash Message -->
            @if(Session::has('message'))
                <div class="bg-green-100 text-green-600 text-sm px-4 py-2">
                    <p>{{ Session::get('message') }}</p>
                </div>
            @else
                <p class="bg-yellow-100 text-yellow-600 text-sm px-4 py-2">
                    Session message not set
                </p>
            @endif

            <!-- Form -->
            <form action="{{ route('siswa.store') }}" method="post" class="p-6 space-y-6">
                @csrf
                @method('post')

                <div>
                    <label for="nis" class="block font-medium text-gray-700">Nis:</label>
                    <input type="number"
                        name="nis" 
                        class="@error('nis') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        placeholder="nis"
                    >
                    @error('nis')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>
                <div>
                    <label for="kelas" class="block font-medium text-gray-700">Kelas:</label>
                    <textarea 
                        name="kelas" 
                        class="@error('kelas') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                        placeholder="Kelas"
                    ></textarea>
                    @error('kelas')
                        <strong class="text-sm text-red-600">{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button 
                        type="submit" 
                        class="py-2 px-6 font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection