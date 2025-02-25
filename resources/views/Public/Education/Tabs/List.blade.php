<section class="container block">
    <div class="mt-2">
        {{
            view("Public.Education.Tabs.Item",[
                'text'      => 'Факультеты',
                'href'      => route('public:education:faculties'),
                'active'    => ($active === 'faculties')
            ])
        }}
        {{
            view("Public.Education.Tabs.Item",[
                'text'  => 'Кафедры',
                'href'      => route('public:education:departments:list'),
                'active'    => ($active === 'departments')
            ])
        }}
        {{
            view("Public.Education.Tabs.Item",[
                'text'  => 'Лаборатории',
                'href'      => route('public:education:labs:list'),
                'active'    => ($active === 'labs')
            ])
        }}
        {{
            view("Public.Education.Tabs.Item",[
                'text'  => 'Филиалы',
                'href'      => route('public:education:branch:list'),
                'active'    => ($active === 'branch')
            ])
        }}
    </div>
</section>
