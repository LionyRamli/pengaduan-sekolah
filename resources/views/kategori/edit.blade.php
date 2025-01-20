@extends('layouts.backend.master')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                    <p class="mt-3 text-lg text-gray-500 dark:text-neutral-500">
                        Edit Data Kategori
                    </p>
                </div>
                
                @if(Session::has('message'))
                    <div>
                        <p class="ml-4 text-sm mt-3 text-gray-500 dark:text-neutral-500">{{ Session::get('message') }}</p>
                    </div>
                @else
                    <p class="p-2 ml-4 text-sm mt-3 text-gray-500 dark:text-neutral-500">Session message not set</p>
                @endif
                
                <form action="{{route('kategori.update', [$kategori->id])}}" method="post" >
                    @csrf
                    @method('put')
                    <div class="p-4 md:p-5">
                    <div>
                        <label for="keterangan" class="block font-medium text-gray-700">Keterangan:</label>
                        <input
                            name="keterangan" value="{{$kategori->keterangan}}"
                            class="@error('keterangan') is-invalid @enderror mt-1 py-2 px-4 w-full bg-gray-100 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"
                            placeholder="keterangan"
                        >
                        @error('keterangan')
                            <strong class="text-sm text-red-600">{{ $message }}</strong>
                        @enderror
                    </div>

                        
                        <div class="mt-6">
                            <button type="submit" class="ml-4 text-sm font-semibold rounded-lg border border-blue-600 text-white bg-blue-700 disabled:opacity-50 disabled:pointer-events-none hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Update
                            </button>   
                        </div>    
                    </div>    
                </form>      
            </div>
        </div>
    </div>
@endsection
