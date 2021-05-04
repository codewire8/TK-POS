<div class="p-6">
<div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-300 rounded-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-600">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    ref #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    product code
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    description
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                   stock in by
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                   stock in date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    qty
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                   vendor
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->refno }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->flavor->pcode }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                   {{ $item->description }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->stock_in_by }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ \Carbon\Carbon::parse($item->stock_in_date)->format('F j, Y') }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->qty }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->vendor->name }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No results found!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        {{ $data->links() }}
    </div>
</div>
