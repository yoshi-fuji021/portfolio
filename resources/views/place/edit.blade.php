<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           変更
       </h2>
   </x-slot>
	<div class="py-12">
		<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

				@if (session('message'))
				<div class="success mt-5 px-4 text-green-900">
					{{ session('message') }}
				</div>
				@endif

        @if (session('error'))
				<div class="error mt-5 px-4 text-red-900">
					{{ session('error') }}
				</div>
				@endif

				<!-- ページ固有要素 -->
				<div class="mt-5 px-4 py-5">
					<!-- エラー表示 -->
					<form method="post" action="{{ route('place.update', ['place' => $place->id]) }}">
            @csrf
            @method('PUT')
						<div class="mb-4">
							<label for="name" class="block mb-2">名前</label>
							<input type="text" id="name" class="form-input w-full border" name="name" value="{{ old('name', $place->name) }}" placeholder="名前"/>
							@error('name')
							<span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4">
							<label for="address" class="block mb-2">住所</label>
							<input type="text" id="address" class="form-input w-full border" name="address" value="{{ old('address', $place->address) }}" placeholder="住所"/>
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
							<textarea id="description" class="form-input w-full border" name="description" rows="5" value="{{ $place->description}}">
                {{ old('description', $place->description) }}
              </textarea>
							@error('description')
							<span class="error mb-4 text-red-900">{{ $message }}</span>
							@enderror
						</div>
						<div class="mb-4 flex items-center">
              <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mx-4" name="action" value="edit">{{ __('変更')}}</button>
              <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mx-4" name="action" value="back">{{ __('戻る')}}</button>
						</div>
					</form>
				</div>
				<!-- /ページ固有要素 ここまで -->
			</div>
		</div>
	</div>
</x-app-layout>