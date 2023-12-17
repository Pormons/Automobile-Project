<div class="w-full p-3 dark:bg-gray-900" wire:ignore.self>
    <div class="mb-5">
        <span class="text-[50px] font-thin">Partner</span>
    </div>
    <section class="sm:p-5">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
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
                                <input class="flex flex-grow bg-transparent focus:border-none focus:ring-0 border-none outline-none" wire:model.live="searchName" id="simple-search" name="simple-search" type="text" placeholder="Name">
                            </div>
                            <div>
                                <select id="countries" wire:model.live="type" class="bg-transparent border-2 rounded-lg focus:ring-0 focus:outline-none outline-none">
                                    <option value="">Partner Type</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Supplier">Supplier</option>
                                  </select>
                            </div>
                    </div>

                    <div data-modal-target="partner-modal" data-modal-toggle="partner-modal"
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button"
                            class="flex items-center justify-center text-white bg-black hover:bg-primary-800 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none focus:ring-0">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add Partner
                        </button>
                    </div>
                    <livewire:admin.components.add-partner />
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Supplier</th>
                                <th scope="col" class="px-4 py-3">Address</th>
                                <th scope="col" class="px-4 py-3">Phone Number</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $partner)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $partner->partner_name }}
                                    </th>
                                    <td class="px-4 py-3">{{ $partner->partner_address }}</td>
                                    <td class="px-4 py-3">{{ $partner->partner_phone }}</td>
                                    <td class="px-4 py-3">{{ $partner->partner_email }}</td>
                                    @if ($partner->partner_type == 'Manufacturer')
                                    <td class="px-4 py-3">
                                        <div class="text-center w-[80%] font-semibold text-white bg-green-500 rounded-lg">
                                            {{ $partner->partner_type }}
                                        </div>
                                    </td>
                                    @else
                                    <td class="px-4 py-3">
                                        <div class="text-center w-[80%] font-semibold text-white bg-blue-500 rounded-lg">
                                            {{ $partner->partner_type }}
                                        </div>
                                    </td>
                                    @endif
                                    <td class="px-4 py-3 flex items-center justify-end gap-3">
                                        <a href="/Admin/Partners/{{ $partner->id }}/Inventory" class=" bg-green-200 rounded-md p-1">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 12a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm10 6H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
                                            </svg>
                                        </a>
                                        <button type="button"
                                        wire:click="delete({{ $partner->id }})"
                                        wire:confirm="Are you sure you want to delete this partner?"
                                            class=" bg-red-500 rounded-md p-1">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="p-4">
                    {{ $partners->links() }}
                </nav>
            </div>
        </div>
    </section>

</div>
