<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           詳細
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

				@if (session('error'))
				<div class="error mt-5 px-4 text-red-900">
					{{ session('error') }}
				</div>
				@endif

				<!-- ページ固有要素 -->
				<div class="mt-5 px-4 py-5">
					<table class="w-full border shadow my-6">
						<tbody>
							<tr>
								<th class="px-3 py-3 text-center border">ID</th>
								<td class="px-3 py-3 border">{{ optional($place)->id }}</td>
							</tr>
							<tr>
								<th class="px-3 py-3 text-center border">名前</th>
								<td class="px-3 py-3 border">{{ optional($place)->name }}</td>
							</tr>
							<tr>
								<th class="px-3 py-3 text-center border">住所</th>
								<td class="px-3 py-3 border">{{ optional($place)->address }}</td>
							</tr>
							<tr>
								<th class="px-3 py-3 text-center border">カテゴリー</th>
								<td class="px-3 py-3 border">{{ optional($place)->category }}</td>
							</tr>
							<tr>
								<th class="px-3 py-3 text-center border">作成日</th>
								<td class="px-3 py-3 border">{{ optional($place)->created_at->format("Y-m-d H:i:s") }}</td>
							</tr>
							<tr>
								<th class="px-3 py-3 text-center border">更新日</th>
								<td class="px-3 py-3 border">{{ optional($place)->updated_at->format("Y-m-d H:i:s") }}</td>
              </tr>
              <tr>
								<th class="px-3 py-3 text-center border">説明</th>
								<td class="px-3 py-3 border">{{ optional($place)->description }}</td>
							</tr>
						</tbody>
					</table>

					<a href="{{ route('place.edit', ['place' => $place->id]) }}" class="bg-blue-500 text-white font-bold px-4 py-3 rounded">編集</a>

					<form style="display:inline" action="{{ route('place.destroy', $place->id) }}" method="post">
          	@csrf
            @method('DELETE')
            <button type="submit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded">{{ __('削除') }}</button>
					</form>
														
					<a href="{{ route('place.index') }}" class="bg-blue-500 text-white font-bold px-4 py-3 rounded">戻る</a>
				</div>
				<!-- /ページ固有要素 ここまで -->
			</div>
		</div>
	</div>
</x-app-layout>
