<form action="{{ route('bid') }}" method="post">
    @csrf
    <input class="w-24 rounded text-gray-400"
           type="text"
           name="bid">
    <button name="lot" value="{{ $lot->id }}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
            type="submit">
        Bid
    </button>
</form>
