@extends('layouts.backend.master')

@section('content')

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                    <p class="mt-3 text-lg text-gray-700 font-semibold dark:text-neutral-500">
                        Daftar Aspirasi
                    </p>
                </div>
                <div class="mt-3 px-5">
                    <a href="{{ route('inputaspirasi.create') }}">
                        <button class="p-2 text-sm font-semibold rounded-md border border-green-600 bg-green-500 text-white hover:bg-blue-700 transition duration-150">
                            Create
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
                        <table class="min-w-full bg-white dark:bg-neutral-900 rounded-lg shadow-lg">
                            <thead class="bg-gray-200 dark:bg-neutral-800 text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="py-3 px-5 text-left">#</th>
                                    <th class="py-3 px-5 text-left">NIS</th>
                                    <th class="py-3 px-5 text-left">Kategori</th>
                                    <th class="py-3 px-5 text-left">Lokasi</th>
                                    <th class="py-3 px-5 text-left">Keterangan</th>
                                    <th class="py-3 px-5 text-left">Foto</th>
                                    <th class="py-3 px-5 text-left">Status</th>
                                    <th class="py-3 px-5 text-center">Edit</th>
                                    <th class="py-3 px-5 text-center">Detail</th>
                                    <th class="py-3 px-5 text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-200">
                                @if(!$aspirasis->isEmpty())
                                    @foreach($aspirasis as $key => $aspirasi)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-800 transition duration-150">
                                            <td class="py-3 px-5">{{$key + 1}}</td>
                                            <td class="py-3 px-5">{{$aspirasi->nis}}</td>
                                            <td class="py-3 px-5">{{$aspirasi->kategori->keterangan}}</td>
                                            <td class="py-3 px-5">{{$aspirasi->lokasi}}</td>
                                            <td class="py-3 px-5">{{$aspirasi->keterangan}}</td>
                                            <td class="py-3 px-5">
                                                <img src="{{ asset('foto/' . $aspirasi->foto) }}" class="w-20 h-20 object-cover rounded-md" alt="Foto">
                                            </td>
                                            <td class="py-3 px-5">
                                                @if (empty(App\Models\Aspirasi::where('input_aspirasi_id', $aspirasi->id)->latest()->first()->status))
                                                    <b>Menunggu</b>
                                                @else
                                                    <b>{{ App\Models\Aspirasi::where('input_aspirasi_id', $aspirasi->id)->latest()->first()->status }}</b>
                                                @endif
                                            </td>
                                            <td class="py-3 px-5 text-center">
                                                <a href="{{ route('inputaspirasi.edit', [$aspirasi->id]) }}">
                                                    <button class="p-1 text-sm font-semibold rounded-md border border-blue-600 bg-blue-600 text-white hover:bg-blue-700 transition duration-150">Edit</button>
                                                </a>
                                            </td>
                                            <td class="py-3 px-5 text-center">
                                            <a href="{{ route('inputaspirasi.show', [$aspirasi->id]) }}">
                                                <button class="btn btn-outline-success">
                                                    <i class="fas fa-fw fa-eye"></i>
                                                </button>
                                            </a>                                            </td>
                                            <td class="py-3 px-5 text-center">
                                                <form method="post" action="{{ route('inputaspirasi.destroy', [$aspirasi->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="p-1 text-sm font-semibold rounded-md border border-red-600 bg-red-600 text-white hover:bg-red-700 transition duration-150">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center py-3">
                                            Tidak ada kategori yang dapat ditampilkan.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
