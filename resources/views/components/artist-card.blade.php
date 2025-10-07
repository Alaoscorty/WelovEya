<div class="card rounded-xl p-6 hover-scale" style="background: url({{ $image }}); height:50vh;" data-genre="{{ $genre }}">
    <div class="flex items-start mb-4">
        <div class="mt-4 bg-blue-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">
            {{ $genre }}
        </div>
    </div>
    <button class="mt-4 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition" style="margin-top: 25vh; margin-left: 20vh; background-color: rgba(255, 255, 255, 0.267);">
        Voter
    </button>
</div>
