@extends('layouts.app') {{-- à adapter selon ton layout --}}

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Dashboard Admin National</h2>
    <p class="mb-2 text-gray-700">Pays : <strong>{{ $country }}</strong></p>

    <h3 class="text-lg font-semibold mt-4 mb-2">Membres dans votre pays :</h3>
    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td class="border px-4 py-2">{{ $member->first_name }} {{ $member->last_name }}</td>
                    <td class="border px-4 py-2">{{ $member->email }}</td>
                    <td class="border px-4 py-2">{{ $member->phone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Aucun membre pour ce pays.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
