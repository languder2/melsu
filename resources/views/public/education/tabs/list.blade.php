<section class="container block ">
    <div class="mt-2 flex flex-col lg:flex-row gap-y-1 flex-wrap">
        @component("public.education.tabs.item",[
                'text'      => 'Институты',
                'href'      => route('public:education:institutes'),
                'active'    => ($active == 'institutes')
        ]) @endcomponent

        {{
            view("public.education.tabs.item",[
                'text'      => 'Факультеты',
                'href'      => route('public:education:faculties'),
                'active'    => ($active == 'faculties')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Кафедры',
                'href'      => route('public:education:departments:list'),
                'active'    => ($active == 'departments')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Научные лаборатории',
                'href'      => route('public.science-labs.list'),
                'active'    => ($active == 'science-labs')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Образовательные лаборатории',
                'href'      => route('public.education-labs.list'),
                'active'    => ($active == 'education-labs')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Филиалы',
                'href'      => route('public:education:branch:list'),
                'active'    => ($active == 'branch')
            ])
        }}
    </div>
</section>
