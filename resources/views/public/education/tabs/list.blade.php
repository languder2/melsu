<section class="container block">
    <div class="mt-2">
        {{
            view("public.education.tabs.item",[
                'text'      => 'Факультеты',
                'href'      => route('public:education:faculties'),
                'active'    => ($active === 'faculties')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Кафедры',
                'href'      => route('public:education:departments:list'),
                'active'    => ($active === 'departments')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Лаборатории',
                'href'      => route('public:labs:list'),
                'active'    => ($active === 'labs')
            ])
        }}
        {{
            view("public.education.tabs.item",[
                'text'  => 'Филиалы',
                'href'      => route('public:education:branch:list'),
                'active'    => ($active === 'branch')
            ])
        }}
    </div>
</section>
