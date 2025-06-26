<?php

namespace App\Http\Controllers\News;

use App\Enums\EventType;
use App\Http\Controllers\Controller;
use App\Models\News\Events;
use App\Models\News\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\News\Category;

class EventsController extends Controller
{
    public function calendar(): View
    {
        $now = Carbon::now();
        $month = request('month', $now->month);
        $year = request('year', $now->year);
        $selectedCategories = request('categories', []);
        
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        $eventsQuery = Events::with('category')
            ->whereNotNull('event_datetime')
            ->whereBetween('event_datetime', [$startOfMonth, $endOfMonth]);
        
        if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
            $eventsQuery->whereIn('category_id', $selectedCategories);
        }
        
        $events = $eventsQuery->orderBy('event_datetime')->get();
        $categories = Category::whereHas('eventsRelation')->orderBy('name')->get();

        
        // Событие по дате
        $groupedEvents = $events->groupBy(function($event) {
            return $event->event_datetime->format('Y-m-d');
        });
        
        // Календарь
        $calendar = [
            'month' => $startOfMonth->translatedFormat('F'),
            'month_num' => $month,
            'year' => $year,
            'weeks' => [],
            'prev' => $startOfMonth->copy()->subMonth(),
            'next' => $startOfMonth->copy()->addMonth(),
        ];
        
        $firstDayOfWeek = $startOfMonth->dayOfWeekIso;
        $daysInMonth = $startOfMonth->daysInMonth;
        $day = 1;
        $weekNumber = 0;
        
        while ($day <= $daysInMonth) {
            $week = [];
            
            for ($dow = 1; $dow <= 7; $dow++) {
                if ($weekNumber === 0 && $dow < $firstDayOfWeek) {
                    $prevMonthDay = $startOfMonth->copy()->subMonth()->endOfMonth()->day - ($firstDayOfWeek - $dow - 1);
                    $prevMonthDate = Carbon::create($year, $month, 1)->subMonth()->setDay($prevMonthDay);
                    
                    $week[] = (object)[
                        'day' => $prevMonthDay,
                        'date' => $prevMonthDate,
                        'date_key' => $prevMonthDate->format('Y-m-d'),
                        'events' => [],
                        'is_today' => false,
                        'is_weekend' => $dow >= 6,
                        'is_adjacent_month' => true,
                        'month_type' => 'prev',
                    ];
                } elseif ($day > $daysInMonth) {
                    $nextMonthDay = $day - $daysInMonth;
                    $nextMonthDate = $startOfMonth->copy()->addMonth()->setDay($nextMonthDay);
                    
                    $week[] = (object)[
                        'day' => $nextMonthDay,
                        'date' => $nextMonthDate,
                        'date_key' => $nextMonthDate->format('Y-m-d'),
                        'events' => [],
                        'is_today' => false,
                        'is_weekend' => $dow >= 6,
                        'is_adjacent_month' => true,
                        'month_type' => 'next',
                    ];
                    $day++;
                } else {
                    $date = Carbon::create($year, $month, $day);
                    $dateKey = $date->format('Y-m-d');
                    
                    $week[] = (object)[
                        'day' => $day,
                        'date' => $date,
                        'date_key' => $dateKey,
                        'events' => $groupedEvents[$dateKey] ?? [],
                        'is_today' => $date->isToday(),
                        'is_weekend' => $dow >= 6,
                        'is_adjacent_month' => false,
                        'month_type' => 'current',
                    ];
                    
                    $day++;
                }
            }
            
            $calendar['weeks'][] = $week;
            $weekNumber++;
        }
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('events.events.public.calendar', [
                    'calendar' => (object)$calendar,
                    'categories' => $categories,
                    'selectedCategories' => $selectedCategories
                ])->render()
            ]);
        }
        
        return view('events.events.public.calendar', [
            'calendar' => (object)$calendar,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories
        ]);
    }
    public function getDayEvents($date)
    {
        try {
            $date = Carbon::parse($date);
            $selectedCategories = request('categories', []);
            
            $eventsQuery = Events::whereDate('event_datetime', $date)
                ->orderBy('event_datetime');
            
            // Категории если выбранны
            if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
                $eventsQuery->whereIn('category_id', $selectedCategories);
            }
            
            $events = $eventsQuery->get(['id', 'title', 'image', 'category_id', 'event_datetime', 'short']);
            
            // Категории которые есть в отфильтрованных событиях
            $categoryIds = $events->pluck('category_id')->filter()->unique();
            
            $categories = Category::whereIn('id', $categoryIds)
                ->get()
                ->keyBy('id');
            
            return response()->json([
                'success' => true,
                'year' => $date->format('Y'),
                'month' => __('month.rod-m-'.$date->format('m')),
                'dayNum' => $date->format('d'),
                'weekDay' => __('month.full-day-'.(($date->dayOfWeek + 6) % 7 + 1)),
                'events' => $events->map(function($item) use ($categories) {
                    $category = $categories[$item->category_id] ?? null;
                    
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'time' => $item->event_datetime->format('H:i'),
                        'image' => $item->preview->src,
                        'category' => $category ? [
                            'id' => $category->id,
                            'name' => $category->name,
                            'color' => config('colors.categories.'.$category->id, '#CCCCCC')
                        ] : [
                            'id' => null,
                            'name' => 'Без категории',
                            'color' => '#CCCCCC'
                        ],
                        'link' => route('public:event:show', $item->id)
                    ];
                })
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Ошибка загрузки событий', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
    
            return response()->json([
                'success' => false,
                'error' => 'Произошла ошибка.'
            ], 500);
        }
    }
    public function list(): View
    {
        $list= Events::orderBy('published_at','desc')->get();
        return view('news.events.admin.list',compact('list'));
    }

    public function form(Events $event): string
    {
        $types = EventType::forSelect();
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('news.events.admin.form', [
            'event' => $event,
            'types' => $types,
            'categories' => $categories
        ])->render();
    }

    public function save(Request $request, ?Events $event)
    {
        $form = $request->validate(Events::FormRules(), Events::FormMessage());
        $event->fill($form)->save();

        if(!$event->preview)
            $event->preview = $event->preview()->create([
                'name'          => $event->title,
                'type'          => 'preview',
            ]);

        if($request->file('image')){
            $event->preview->relation()->associate($event)->saveImage($request->file('image'));
        }
        elseif($request->has('preview')){
            $event->preview->name = $event->title;
            $event->preview->getReferenceID($request->has('preview'));
        }
        else{
            $event->preview->reference_id = null;
            $event->preview->filename = null;
            $event->preview->filetype = null;
        }

        $event->preview->save();

        return redirect()->route('admin:events');
    }

    public function delete(Events $event)
    {
        $event->delete();
        return redirect()->back();
    }

    public function all(Request $request): View
    {
        $list =  Events::orderBy('published_at', 'desc')
            ->select('id', 'title', 'short', 'full', 'published_at')
            ->paginate(13);

        return view('news.events.public.list',compact('list'));
    }
    public function show(?Events $event): View | RedirectResponse
    {
        if(!$event)
            return  redirect()->route('public:events:list');

        return view('news.events.public.show', compact('event'));
    }



}
