<form action="{{ route('place.search') }}" method="post">
	@csrf
	<div class="flex flex-wrap">
		<div class="w-2/3">
			<input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="検索するテキストを入力">
		</div>
		<div class="w-1/3 px-6">
			<input class="shadow bg-gray-500 text-white font-bold py-2 px-4 rounded" type="submit" value="検索">
		</div>
	</div>
</form>