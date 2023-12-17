<div class="w-full p-3  dark:bg-gray-900" wire:ignore.self>
    <div class="flex flex-col items-start space-y-5 mb-2">
        <a href="{{ route('partners') }}"
            class="bg-blue-300 p-2 flex items-center justify-center rounded-lg text-[20px] hover:bg-blue-900 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            BACK
        </a>
        <span class="text-[40px] font-thin">{{ $name }} - Stocks </span>
    </div>
    <section class="sm:p-5">
        <div class="mx-auto max-w-screen-xl">

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-[40%] flex flex-row space-x-2">
                        <div class="flex flex-row-reverse border-2 rounded-lg pr-2">
                            <div class="flex items-center">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                class="flex flex-grow bg-transparent focus:border-none focus:ring-0 border-none outline-none"
                                wire:model.live="search" id="simple-search" name="simple-search" type="text"
                                placeholder="Name">
                        </div>
                        @if ($type === 'Supplier')
                            <div>
                                <select id="countries" wire:model.live="part_type"
                                    class="bg-transparent border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                    <option selected>Part Type</option>
                                    <option value="Engine">Engine</option>
                                    <option value="Axle">Axle</option>
                                    <option value="Transmission">Transmission</option>
                                    <option value="Shock Absorber">Shock Absorber</option>
                                </select>
                            </div>

                        @endif
                    </div>

                    @if ($type === 'Supplier')
                        <div data-modal-target="parts-modal" data-modal-toggle="parts-modal"
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button"
                                class="flex items-center justify-center text-white bg-black hover:bg-primary-800 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none focus:ring-0">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add Parts
                            </button>
                        </div>
                        <livewire:admin.components.add-parts :$partnerId />
                    @endif


                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                @if ($type === 'Supplier')
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">Type</th>
                                    <th scope="col" class="px-4 py-3">Manufactured Date</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                @else
                                    <th scope="col" class="px-4 py-3">Model</th>
                                    <th scope="col" class="px-4 py-3">Variant</th>
                                    <th scope="col" class="px-4 py-3">Color</th>
                                    <th scope="col" class="px-4 py-3">Body</th>
                                    <th scope="col" class="px-4 py-3">Model Year</th>
                                    <th scope="col" class="px-4 py-3">Price</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">Manufactured Date</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr class="border-b dark:border-gray-700">
                                    @if ($type === 'Supplier')
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $stock->part_name }}
                                        </th>
                                        <td class="px-4 py-3">{{ $stock->part_type }}</td>
                                        <td class="px-4 py-3">{{ $stock->manufactured_date }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end gap-3">
                                            <button type="button"
                                                onclick="confirm('Are you sure you want to delete the user {{ $stock->part_name }}? This action will also delete all data associated with this user.') || event.stopImmediatePropagation()"
                                                wire:click="delete({{ $stock->id }})"
                                                class=" bg-red-500 rounded-md p-1">
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    @else
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $stocks->vin }}
                                        </th>
                                        <td class="px-4 py-3">{{ $stock->model }}</td>
                                        <td class="px-4 py-3">{{ $stock->variant }}</td>
                                        <td class="px-4 py-3">{{ $stock->color }}</td>
                                        <td class="px-4 py-3">{{ $stock->body }}</td>
                                        <td class="px-4 py-3">{{ $stock->model_year }}</td>
                                        <td class="px-4 py-3">{{ $stock->price }}</td>
                                        <td class="px-4 py-3">{{ $stock->status }}</td>
                                        <td class="px-4 py-3">{{ $stock->manufactured_date }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end gap-3">
                                            <button type="button"
                                                wire:click="delete({{ $stock->id }})"
                                                wire:confirm="Are you sure you want to delete this stock?"
                                                class=" bg-red-500 rounded-md p-1">
                                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="p-4">
                    {{ $stocks->links() }}
                </nav>
            </div>
        </div>
    </section>
</div>
