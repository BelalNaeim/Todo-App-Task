<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card-body">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-info my-2">Go Back</a><br>
                        <b>Your Todo Title is : {{ $todo->title }}</b><br>
                        <b>Your Todo Description is : {{ $todo->description }}</b><br>
                        <b>Your Todo Author is : {{ $todo->user->name }}</b><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
