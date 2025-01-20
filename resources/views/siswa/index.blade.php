@extends('layouts.backend.master')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                    <p class="mt-3 text-lg text-gray-700 font-semibold dark:text-neutral-500">
                        Daftar Siswa
                    </p>
                </div>
                <div class="mt-3 px-5 ">
                    <a href="{{ route('siswa.create')}}">
                        <button class=" p-2 text-sm font-semibold rounded-md border border-green-600 bg-green-500 text-white hover:bg-blue-700 transition duration-150">Create</button>
                    </a>
                </div>
                @if(Session::has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded-md m-4">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @else
                    <p class="p-2 ml-4 text-sm mt-3 text-gray-500 dark:text-neutral-500">Session message not set</p>
                @endif
                
                <div class="p-4 md:p-5">
                    <table class="min-w-full bg-white dark:bg-neutral-900 rounded-lg shadow-lg overflow-hidden">
                        <thead class="bg-gray-200 dark:bg-neutral-800 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="py-3 px-5 text-left">#</th>
                                <th class="py-3 px-5 text-left">NIS</th>
                                <th class="py-3 px-5 text-left">Kelas</th>
                                <th class="py-3 px-5 text-center">Edit</th>
                                <th class="py-3 px-5 text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200">
                            @if(!$siswas->isEmpty())
                                @foreach($siswas as $key => $siswa)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-800 transition duration-150">
                                        <td class="py-3 px-5">{{$key + 1}}</td>
                                        <td class="py-3 px-5">{{$siswa->nis}}</td>
                                        <td class="py-3 px-5">{{$siswa->kelas}}</td>
                                        <td class="py-3 px-5 text-center">
                                            <a href="{{ route('siswa.edit', [$siswa->nis]) }}">
                                                <button class="p-1 text-sm font-semibold rounded-md border border-blue-600 bg-blue-600 text-white hover:bg-blue-700 transition duration-150">Edit</button>
                                            </a>
                                        </td>
                                        <td class="py-3 px-5 text-center">
                                        <form method="post" action="{{route('siswa.destroy', [$siswa->nis])}}">
                                            @csrf
                                            @method('delete')
                                            <input class="p-1 text-sm font-semibold rounded-md border border-red-600 bg-red-600 text-white hover:bg-red-700 transition duration-150" type="submit" value="Delete" />
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center py-3">Tidak ada kategori yang dapat ditampilkan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity hidden" id="deleteModal">
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Are you sure?</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">Are you sure you want to delete this data? This action cannot be undone.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" onclick="confirmDelete()">Yes</button>
                                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" onclick="closeDeleteModal()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form to submit delete action -->
            <form id="deleteForm" method="post" class="hidden">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>


@endsection 
