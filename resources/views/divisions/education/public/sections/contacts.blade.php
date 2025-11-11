@props([
    'contacts' => collect()
])
@php
    $contacts = $contacts->groupBy('type')
@endphp
<div class="bg-white mb-8">
    <section class="container px-2">
        <div class="grid grid-cols-1 2xl:grid-cols-[repeat(8,auto)] py-7 px-2.5 2xl:px-0 gap-5">
            <div class="flex flex-col gap-5">
                <h3 class="font-bold text-xl">Контакты</h3>
                <div class="flex flex-col gap-4">

                    @foreach($contacts->get('phone') ?? [] as $item)
                        <a href="{{ "tel:".$item->content }}" class="flex items-center gap-3">
                    <span>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.832 15.568C13.0385 15.6628 13.2712 15.6845 13.4917 15.6294C13.7122 15.5744 13.9073 15.4458 14.045 15.265L14.4 14.8C14.5863 14.5516 14.8279 14.35 15.1056 14.2111C15.3833 14.0723 15.6895 14 16 14H19C19.5304 14 20.0391 14.2107 20.4142 14.5858C20.7893 14.9609 21 15.4696 21 16V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21C14.2261 21 9.64773 19.1036 6.27208 15.7279C2.89642 12.3523 1 7.7739 1 3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H6C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3V6C8 6.31049 7.92771 6.61672 7.78885 6.89443C7.65 7.17214 7.44839 7.41371 7.2 7.6L6.732 7.951C6.54842 8.09118 6.41902 8.29059 6.36579 8.51535C6.31256 8.74012 6.33878 8.97638 6.44 9.184C7.80668 11.9599 10.0544 14.2048 12.832 15.568Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                            {{ $item->content }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-5 2xl:pt-12">
                <div class="flex flex-col gap-4">
                    @foreach($contacts->get('email') ?? [] as $item)
                        <a href="{{ "mailto:$item->content" }}" class="flex items-center gap-3">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 7L13.009 12.727C12.7039 12.9042 12.3573 12.9976 12.0045 12.9976C11.6517 12.9976 11.3051 12.9042 11 12.727L2 7" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20 4H4C2.89543 4 2 4.89543 2 6V18C2 19.1046 2.89543 20 4 20H20C21.1046 20 22 19.1046 22 18V6C22 4.89543 21.1046 4 20 4Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </span>
                            {{ $item->content }}
                        </a>
                    @endforeach
                </div>
            </div>

            @foreach($contacts->get('address') ?? [] as $item)
                <div class="flex flex-col gap-5">
                    <h3 class="font-bold text-xl">
                        {{ $item->title ?? 'Расположение' }}

                    </h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.106 5.55326C14.3836 5.69198 14.6897 5.76419 15 5.76419C15.3103 5.76419 15.6164 5.69198 15.894 5.55326L19.553 3.72326C19.7056 3.64702 19.8751 3.61107 20.0455 3.61883C20.2159 3.62659 20.3814 3.6778 20.5265 3.76759C20.6715 3.85738 20.7911 3.98277 20.874 4.13184C20.9569 4.28091 21.0003 4.4487 21 4.61926V17.3833C20.9999 17.5689 20.9481 17.7509 20.8505 17.9088C20.7528 18.0667 20.6131 18.1943 20.447 18.2773L15.894 20.5543C15.6164 20.693 15.3103 20.7652 15 20.7652C14.6897 20.7652 14.3836 20.693 14.106 20.5543L9.894 18.4483C9.6164 18.3095 9.31033 18.2373 9 18.2373C8.68967 18.2373 8.3836 18.3095 8.106 18.4483L4.447 20.2783C4.29436 20.3545 4.12473 20.3905 3.95426 20.3827C3.78379 20.3749 3.61816 20.3236 3.47312 20.2337C3.32808 20.1438 3.20846 20.0182 3.12565 19.869C3.04284 19.7198 2.99958 19.5519 3 19.3813V6.61826C3.0001 6.4326 3.05189 6.25063 3.14956 6.09273C3.24722 5.93484 3.38692 5.80725 3.553 5.72426L8.106 3.44726C8.3836 3.30854 8.68967 3.23633 9 3.23633C9.31033 3.23633 9.6164 3.30854 9.894 3.44726L14.106 5.55326Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 5.76367V20.7637" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 3.23633V18.2363" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                            <span>
                        {{ $item->content }}
                    </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
