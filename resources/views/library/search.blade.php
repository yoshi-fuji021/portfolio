<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        検索結果
      </h2>
   </x-slot>
	<div class="py-12">
		<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<div class="mt-5 px-4 py-5">

					@include("place.place_search_form")

					@if (!empty($message))
          	<div class="success mt-5 px-4 text-green-900">
            	{{ $message }}
            </div>
					@endif

						<table class="w-full border shadow my-6">
							<thead>
								<tr class="py-3">
									<th class="px-3 py-3 text-center border">名前</th>
								</tr>
							</thead>

							<tbody>
							@foreach( $items as $item )
								<tr>
									<td class="px-3 py-3 text-center border">{{ $item['formal'] }}</td>
									<td class="px-3 py-3 text-center border">
										<a href="#" class="bg-blue-500 text-whitefont-bold px-4 py-3 rounded">詳細</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>

						{{ $paginator->appends(request()->input())->render() }}
				</div>
			</div>
		</div>
	</div>
</x-app-layout>