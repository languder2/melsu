document.addEventListener('DOMContentLoaded', function() {
    initCalendarHandlers();
    
    initMonthNavigation();

    initCategoryFilters();
});

function initCategoryFilters() {
    const allRadio = document.querySelector('.all-categories-radio');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    
    // Обработчик Все
    allRadio.addEventListener('change', function() {
        if (this.checked) {
            categoryCheckboxes.forEach(checkbox => checkbox.checked = false);
            applyCategoryFilter(['all']);
        }
    });
    
    // Обработчики чекбоксов
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // если выбран "Все" снимается
            allRadio.checked = false;
            
            const selectedCategories = getSelectedCategories();
            
            // Если все чекбоксы не выбраны включается радио кнопка
            if (selectedCategories.length === 0) {
                allRadio.checked = true;
                applyCategoryFilter(['all']);
            } else {
                applyCategoryFilter(selectedCategories);
            }
        });
    });
}

function getSelectedCategories() {
    const selected = [];
    document.querySelectorAll('.category-checkbox:checked').forEach(checkbox => {
        selected.push(checkbox.value);
    });
    return selected;
}


function applyCategoryFilter(selectedCategories) {
    const url = new URL(window.location.href);
    const params = new URLSearchParams();
    
    params.set('month', url.searchParams.get('month') || new Date().getMonth() + 1);
    params.set('year', url.searchParams.get('year') || new Date().getFullYear());
    
    // Добавляются категории если не выбранно все
    if (!selectedCategories.includes('all')) {
        selectedCategories.forEach(cat => params.append('categories[]', cat));
    }
    
    window.location.href = `${url.pathname}?${params.toString()}`;
}

function initCalendarHandlers() {
    const eventsContainer = document.getElementById('day-events-container');
    
    document.querySelectorAll('.calendar-day').forEach(day => {
        day.addEventListener('click', async function() {
            document.querySelectorAll('.calendar-day').forEach(el => {
                el.classList.remove('border-[#C10F1A]');
            });
            this.classList.add('border-[#C10F1A]');

            if (this.dataset.date) {
                await loadDayEvents(this.dataset.date, eventsContainer);
            }
        });
    });
}

function handleAdjacentMonthClick(dayElement) {
    if (!dayElement.dataset.date) return;
    
    const date = new Date(dayElement.dataset.date);
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    
    // Переход на выбранный месяц
    window.location.href = `/events/calendar?month=${month}&year=${year}`;
}

async function loadDayEvents(date, container) {
    try {
        container.innerHTML = '<div class="p-4">Загрузка...</div>';

        const selectedCategories = getSelectedCategories();
        
        // Добавление фильтрации к запросу
        const url = new URL(`/events/day/${date}`, window.location.origin);
        selectedCategories.forEach(cat => url.searchParams.append('categories[]', cat));
        
        const response = await fetch(url.toString());
        
        if (!response.ok) throw new Error('Ошибка загрузки событий');
        
        const {dayNum, month, year, weekDay, events = []} = await response.json();
        
        // Динамическая отрисовка событий
        container.innerHTML = events.length ? `
            <div class="p-5 bg-[#C10F1A] text-white flex justify-between mb-5 xl:mb-8">
                <span class="w-[60px] h-[60px] 2xl:w-[80px] 2xl:h-[80px]">
                    <svg width="100%" height="100%" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M67.5 74.1665H12.5C9.74 74.1665 7.5 71.9265 7.5 69.1665V14.1665C7.5 11.404 9.74 9.1665 12.5 9.1665H17.5V11.6665C17.5 15.809 20.8575 19.1665 25 19.1665C29.1425 19.1665 32.5 15.809 32.5 11.6665V9.1665H47.5V11.6665C47.5 15.809 50.86 19.1665 55 19.1665C59.14 19.1665 62.5 15.809 62.5 11.6665V9.1665H67.5C70.26 9.1665 72.5 11.404 72.5 14.1665V69.1665C72.5 71.9265 70.26 74.1665 67.5 74.1665ZM67.5 26.6665H12.5V69.1665H67.5V26.6665ZM25 39.1665H17.5V31.6665H25V39.1665ZM25 51.6665H17.5V44.1665H25V51.6665ZM25 64.1665H17.5V56.6665H25V64.1665ZM37.5 39.1665H30V31.6665H37.5V39.1665ZM37.5 51.6665H30V44.1665H37.5V51.6665ZM37.5 64.1665H30V56.6665H37.5V64.1665ZM50 39.1665H42.5V31.6665H50V39.1665ZM50 51.6665H42.5V44.1665H50V51.6665ZM50 64.1665H42.5V56.6665H50V64.1665ZM62.5 39.1665H55V31.6665H62.5V39.1665ZM62.5 51.6665H55V44.1665H62.5V51.6665ZM62.5 64.1665H55V56.6665H62.5V64.1665ZM54.9225 16.6665C52.2025 16.6665 50 14.4615 50 11.744V6.589C50 3.869 52.2025 1.6665 54.9225 1.6665C57.6425 1.6665 59.845 3.869 59.845 6.589V11.744C59.845 14.4615 57.6425 16.6665 54.9225 16.6665ZM24.9225 16.6665C22.2025 16.6665 20 14.4615 20 11.744V6.589C20 3.869 22.2025 1.6665 24.9225 1.6665C27.6425 1.6665 29.845 3.869 29.845 6.589V11.744C29.845 14.4615 27.64 16.6665 24.9225 16.6665Z" fill="white"/>
                    </svg>
                </span>
                <div class="flex flex-col gap-3 items-end">
                    <h3 class="text-2xl 2xl:text-3xl font-semibold">${dayNum} ${month} ${year}</h3>
                    <h4>${weekDay}</h4>
                </div>
            </div>
            <div>
                ${events.map(e => `
                    <a href="${e.link}" class="border grid grid-cols-[60%_auto] gap-5 border-transparent transition duration-300 ease-linear p-5 hover:border-[#000000] cursor-pointer sm:max-h-auto box-border">
                        <div class="flex flex-col justify-between">
                            <div>
                                <h4 class="font-semibold xl:text-lg mb-1 line-clamp-2" title="${e.title}">${e.title}</h4>
                                <div class="flex items-center gap-2 mb-1">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                                            <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"/>
                                            <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"/>
                                        </svg>
                                    </span>
                                    <span>${e.time}</span>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div style="background-color: ${e.category.color}" class="w-[16px] h-[16px] rounded-[4px]" ></div>
                                <span>${e.category.name}</span>
                            </div>
                        </div>
                        <div class="max-h-[128px] sm:max-h-auto">
                            <img class="h-full sm:h-auto lg:h-full object-fill" src="${e.image}" alt="">
                        </div>
                    </a>
                `).join('')}
            </div>
        ` : `<div class="p-5">В этот день событий нет</div>`;
    } catch (error) {
        console.error('Ошибка загрузки событий:', error);
        container.innerHTML = '<div class="p-4 text-red-500">Ошибка загрузки событий</div>';
    }
}

function initMonthNavigation() {
    document.querySelectorAll('.month-navigation a').forEach(link => {
        link.addEventListener('click', async function(e) {
            e.preventDefault();
            const selectedCategories = getSelectedCategories();
            
            try {
                // Добавление фильтров в сылку
                const url = new URL(this.href);
                selectedCategories.forEach(cat => {
                    url.searchParams.append('categories[]', cat);
                });
                
                const response = await fetch(url.toString());
                const html = await response.text();
                
                // Обнавление календаря
                const calendarContainer = document.querySelector('.events-calendar-container');
                const newCalendar = new DOMParser()
                    .parseFromString(html, 'text/html')
                    .querySelector('.events-calendar-container');
                
                if (newCalendar) {
                    calendarContainer.innerHTML = newCalendar.innerHTML;
                    initCalendarHandlers();
                    initMonthNavigation();
                    window.history.pushState({}, '', url.toString());
                } else {
                    window.location.href = url.toString();
                }
            } catch (error) {
                console.error('Ошибка AJAX-загрузки:', error);
                window.location.href = this.href;
            }
        });
    });
}

// Обработка навигации
window.addEventListener('popstate', function() {
    window.location.reload();
});