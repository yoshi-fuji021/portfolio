<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        一覧
      </h2>
	 </x-slot>
	
		<div class="py-12">
			<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<!-- ページ固有要素 -->
					<div class="mt-5 px-4 py-5">
						
						<a href="{{ route('place.create') }}" class="bg-blue-500 text-white font-bold px-4 py-3 rounded float-right mr-5">作成</a>

						@include("place.place_search_form")

						@if (session('message'))
							<div class="success mt-5 px-4 text-green-900">
								{{ session('message') }}
							</div>
						@endif
						
						<table class="w-full border shadow my-6">
							<thead>
								<tr class="py-3">
									<th class="px-3 py-3 text-center border">ID</th>
									<th class="px-3 py-3 text-center border">名前</th>
									<th class="px-3 py-3 text-center border">カテゴリー</th>
									<th class="px-3 py-3 text-center border">作成日</th>
									<th class="px-3 py-3 text-center border">更新日</th>
									<th class="px-3 py-3 text-center border"></th>
									<th class="px-3 py-3 text-center border"></th>
								</tr>
							</thead>

							<tbody>
								@foreach($places as $place)
									<tr>
										<td class="px-3 py-3 text-center border">{{ $place->id }}</td>
										<td class="px-3 py-3 text-center border">{{ $place->name }}</td>
										<td class="px-3 py-3 text-center border">
											@if ($place->category === 0) 
												図書館
											@elseif ($place->category === 1)
												カフェ
											@else ($place->category === 2)
												その他
											@endif
										</td>
										<td class="px-3 py-3 text-center border">{{ $place->created_at->format("Y-m-d H:i:s") }}</td>
										<td class="px-3 py-3 text-center border">{{ $place->updated_at->format("Y-m-d H:i:s") }}</td>
										<td class="px-3 py-3 text-center border">
											<a href="{{ route('place.show', ['place' => $place->id])}}" class="bg-blue-500 text-white font-bold px-4 py-3 rounded">詳細</a>
										</td>
										<td class="text-center">
											@if($place->is_liked_by_auth_user())
												<a href="{{ route('place.unlike', ['id' => $place->id]) }}" class="btn  bg-red-300 px-4 py-3 rounded">いいね<span class="badge">{{ $place->likes->count() }}</span></a>
											@else
												<a href="{{ route('place.like', ['id' => $place->id]) }}" class="btn bg-gray-400 px-4 py-3 rounded">いいね<span class="badge">{{ $place->likes->count() }}</span></a>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{ $places->links() }}
					</div>
					<!-- /ページ固有要素 ここまで -->
				</div>
			</div>
		</div>
</x-app-layout>