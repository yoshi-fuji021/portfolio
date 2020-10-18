<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          登録フォーム
       </h2>
   </x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				@if (session('message'))
				<div class="success mt-5 px-4 text-green-900">
					{{ session('message') }}
				</div>
				@endif
				<!-- ページ固有要素 -->
				<div class="mt-5 px-4 py-5">
					<form method="post" action="{{ route('place.store') }}">
						@csrf
						<div class="mb-4">
							<label for="name" class="block mb-2">名前</label>
							<input type="text" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" value="{{ old('name') }}"/>
							@error('name')
							  <span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4">
							<label for="address" class="block mb-2">住所</label>
							<input type="text" id="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="address" value="{{ old('address') }}"/>
							@error('address')
							  <span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4">
							<label for="category" class="block mb-2">カテゴリー</label>
								<input name="category" type="radio" value="0">図書館<br>
								<input name="category" type="radio" value="1">カフェ<br>
								<input name="category" type="radio" value="2">その他<br>
							@error('category')
							  <span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4">
							<label for="description" class="block mb-2">説明</label>
							<textarea type="text" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" rows="5">
                {{ old('description') }}
              </textarea>
							@error('description')
							  <span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4 flex items-center">
							<input type="submit" value="作成" class="bg-blue-500 text-white font-bold py-2 px-4 rounded" />
						</div>
					</form>
				</div>
				<!-- /ページ固有要素 ここまで -->
			</div>
		</div>
	</div>
</x-app-layout>