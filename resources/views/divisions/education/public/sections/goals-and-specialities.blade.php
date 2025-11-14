@props([
    'division' => New \App\Models\Division\Division()
])
<div class="flex flex-col gap-7">

    <div class="flex flex-col gap-7">
        <div class="flex">
            <button id="goalsBtn" class="py-2.5 px-7.5 cursor-pointer font-bold text-[#C10F1A] border border-[#C10F1A] transition duration-300 ease-linear
                                    hover:text-white hover:bg-[#C10F1A]
                                    text-white bg-[#C10F1A]">
                Цели и задачи
            </button>

            <button id="directionBtn" class="py-2.5 px-7.5 cursor-pointer font-bold text-[#C10F1A] border-l-0 border border-[#C10F1A] transition duration-300 ease-linear
                                    hover:text-white hover:bg-[#C10F1A]">
                Направления подготовки
            </button>
        </div>
    </div>
    <div id="goals-faculty" class="flex flex-col gap-5">
        <h2 class="font-bold">Основными задачами факультета являются:</h2>
        <div class="grid md:grid-cols-[51%_auto] gap-5">
            <div class="flex gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p>
                    Многоуровневая подготовка обучающихся (бакалавриат, магистратура, научно-педагогические кадры высшей квалификации) и повышение квалификации по направлениям, закрепленным за факультетом;
                </p>
            </div>

            <div class="flex gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p>
                    Интеграции образования, науки и производства путем использования результатов научных исследований в учебном процессе и развития сотрудничества между образовательными, научными, опытно-производственными, научно-производственными учреждениями и предприятиями.
                </p>
            </div>

            <div class="flex gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p>
                    Развитие научного потенциала для подготовки высококвалифицированных специалистов;
                </p>
            </div>

            <div class="flex gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p>
                    Взаимодействие и укрепление связей с крупнейшими предприятиями агропромышленного комплекса нашего региона.
                </p>
            </div>
            <div class="flex gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p>
                    Активное развитие сотрудничества с ведущими учебными заведениями страны и международных связей факультета,
                </p>
            </div>
        </div>
    </div>
    <div id="areas-training" class="flex flex-col gap-5 hidden">
        <h2 class="font-bold">Факультет осуществляет подготовку специалистов по направлениям:</h2>
        <div class="grid md:grid-cols-[51%_auto] gap-5">
            <div class="flex flex-col gap-6">
                <h3 class="font-bold">Бакалавриат:</h3>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                        </div>
                        <p class="text-sm">
                            06.03.02 – ПОЧВОВЕДЕНИЕ (профиль: Управление качеством почв и биотехнологии)
                        </p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                        </div>
                        <p class="text-sm">
                            15.03.02 – ТЕХНОЛОГИЧЕСКИЕ МАШИНЫ И ОБОРУДОВАНИЕ (профиль: Компьютерный инжиниринг пищевых производств)
                        </p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                        </div>
                        <p class="text-sm">
                            19.03.02 – ПРОДУКТЫ ПИТАНИЯ ИЗ РАСТИТЕЛЬНОГО СЫРЬЯ (профиль: Технология пищевых продуктов общего и специального назначения)
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-6">
                <h3 class="font-bold">Магистратура:</h3>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                        </div>
                        <p class="text-sm">
                            15.04.02 – ТЕХНОЛОГИЧЕСКИЕ МАШИНЫ И ОБОРУДОВАНИЕ (профиль: Компьютерный инжиниринг пищевых производств)
                        </p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                            <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                        </div>
                        <p class="text-sm">
                            19.04.02 – ПРОДУКТЫ ПИТАНИЯ ИЗ РАСТИТЕЛЬНОГО СЫРЬЯ (профиль: Организация, ведение и проектирование технологий пищевых продуктов)
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="font-bold">Выпускники факультета занимают широкий спектр должностей в таких сферах как:</h2>
        <div class="grid md:grid-cols-[51%_auto] gap-5">
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    сельскохозяйственные предприятия разных форм собственности по выращиванию продукции открытого и защищенного грунта;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    фирмы по реализации семян, пестицидов и агрохимикатов;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    промышленные предприятия по переработке продукции растениеводства;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    отделения Государственной семенной инспекции;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    фирмы по реализации семян, пестицидов и агрохимикатов;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    фирмы по строительству систем орошения и мелиорации;
                </p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative">
                    <span class="bg-red-700 absolute text-white text-xs rounded-full h-4 w-4 flex items-center justify-center animate-ping"></span>
                    <span class="bg-red-700 relative text-white text-xs rounded-full h-4 w-4 flex items-center justify-center"></span>
                </div>
                <p class="text-sm">
                    образовательные и научно-исследовательские учреждения.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded',()=>{
        let goalsBtn = document.querySelector('#goalsBtn');
        let directionBtn = document.querySelector('#directionBtn');

        let goalsBox = document.querySelector('#goals-faculty');
        let directionBox = document.querySelector('#areas-training');

        const activeClasses = ['text-white', 'bg-[#C10F1A]'];

        function setActiveTab(activeBtn, activeBox, inactiveBtn, inactiveBox) {
            const isActive = activeBtn.classList.contains(activeClasses[0]) &&
                activeBtn.classList.contains(activeClasses[1]);

            if (isActive) {
                return;
            }

            activeBtn.classList.add(...activeClasses);
            activeBox.classList.remove('hidden');

            inactiveBtn.classList.remove(...activeClasses);
            inactiveBox.classList.add('hidden');
        }

        goalsBtn.addEventListener('click', () => {
            setActiveTab(goalsBtn, goalsBox, directionBtn, directionBox);
        });

        directionBtn.addEventListener('click', () => {
            setActiveTab(directionBtn, directionBox, goalsBtn, goalsBox);
        });

        let moreBtn = document.querySelector('.moreBtn');
        let historyBox = document.querySelector('.history-box');
        moreBtn.addEventListener('click', ()=>{
            historyBox.classList.toggle('max-h-[424px]');
        })
    });
</script>
