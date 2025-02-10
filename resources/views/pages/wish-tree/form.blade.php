<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Елка желаний</title>
</head>
<body class="bg-[gray]">
<section class="flex items-center min-h-[100vh]">
    <div
        class="container mx-auto bg-white bg-[url({{asset('images/wish-tree/sneg-5.png')}})] sm:bg-[url({{asset('images/wish-tree/sneg-4.png')}})] md:bg-[url({{asset('images/wish-tree/sneg-3.png')}})] lg:bg-[url({{asset('images/wish-tree/sneg-2.png')}})] xl:bg-[url({{asset('images/wish-tree/sneg-1.png')}})]">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] p-6 xl:p-12">
            <div class="order-1 sm:order-2 lg:order-1">
                <div class="grid grid-cols-[1fr_1fr]">
                    <div class="col-span-2 flex justify-start lg:justify-center xl:justify-end">
                        <img src="{{asset('images/wish-tree/ball.png')}}" alt=""
                             class="w-[220px] sm:w-[320px] xl:w-[650px]">
                    </div>
                    <div class="justify-end pe-12 py-6 hidden sm:flex">
                        <img src="{{asset('images/wish-tree/logo.png')}}" alt="" class="w-[130px] xl:w-[180px]">
                    </div>
                    <div class="justify-start border-s-2 border-[#9F9F9F] ps-12 py-6 hidden sm:flex">
                        <img src="{{asset('images/wish-tree/logo-usta.png')}}" alt="" class="w-[153px] xl:w-[212px]">
                    </div>
                </div>
            </div>
            <div class="order-2 sm:order-1 lg:order-2">
                <div class="wrapp  bg-[url({{asset('images/wish-tree/border.png')}})] bg-no-repeat p-6 sm:relative">
                    <div class="flex justify-center">
                        <h2 class="text-[32px] md:text-[33px] xl:text-[42px] text-[#F95752] font-[700]">ЕЛКА ЖЕЛАНИЙ
                            МЕЛГУ</h2>
                    </div>
                    <form class="" action="{{route('wish-tree:save')}}" method="POST">
                        @csrf
                        <div class="grd grid grid-cols-[1fr_1fr] md:grid-cols-[1fr_1fr_1fr] gap-6 text-xl mb-6">
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 w-[100%]"
                                   name="lastname" placeholder="Фамилия" required>
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 w-[100%]"
                                   name="firstname" placeholder="Имя" required>
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 col-span-2 md:col-span-1 w-[100%]"
                                   name="middlename" placeholder="Отчество">
                        </div>
                        <div class="grd grid grid-cols-[1fr_1fr] gap-6 text-xl">
                            <select
                                class="border-dotted border-b-2 border-[#C4C4C4] text-[#E7E7E7] p-1 font-[400] outline-0"
                                name="faculty">
                                <option value="">Факультет</option>
                                <option value="Технический">Технический</option>
                                <option value="Экономический">Экономический</option>
                                <option value="Агротехнологический">Агротехнологический</option>
                                <option value="Гуманитарно-педагогический">Гуманитарно - педагогический</option>
                                <option value="Естественные науки">естественные науки</option>
                                <option value="Юридический">Юридический</option>
                            </select>
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 w-[100%]"
                                   name="speciality" placeholder="Специальность">
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 col-span-2 md:col-span-1 w-[100%]"
                                   name="phone" placeholder="Номер телефона">
                            <input type="text"
                                   class="border-dotted border-b-2 border-[#C4C4C4] placeholder:text-[#E7E7E7] p-1 font-[400] outline-0 col-span-2 md:col-span-1 w-[100%]"
                                   name="tg" placeholder="Телеграм">
                        </div>
                        <div class="textarea-with-lines">
                            <textarea placeholder="Задай вопрос ректору" maxlength="150" spellcheck="false"
                                      class="myTextarea placeholder:text-[#E7E7E7] font-[400]"
                                      name="question"></textarea>
                            <div class="line-underline line-underline-1"></div>
                            <div class="line-underline line-underline-2"></div>
                            <div class="charCount text-end text-[#E7E7E7] text-[14px]"><span
                                    class="remainingChars">150</span></div>
                        </div>
                        <div class="w-[100%] flex justify-end">
                            <div class="text-area-box textarea-with-lines w-[80%]">
                                <textarea placeholder="Поделись своим желанием" maxlength="350" spellcheck="false"
                                          class="myTextarea placeholder:text-[#E7E7E7] font-[400]"
                                          name="wish"></textarea>
                                <div class="line-underline line-underline-1"></div>
                                <div class="line-underline line-underline-2"></div>
                                <div class="charCount text-end text-[#E7E7E7] text-[14px]"><span class="remainingChars">350</span>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full flex justify-center">
                            <button type="submit"
                                    class="rounded-[16px] text-lg py-[4px] px-[12px] text-white bg-[#F95752] border-[1px] border-[#F95752] hover:bg-white hover:text-[#F95752] transition-all duration-300 ease-linear">
                                Отправить
                            </button>
                        </div>
                    </form>
                    <img src="{{asset('images/wish-tree/ball-note.png')}}" alt="" class="ball-note
                        absolute
                        xl:w-[282px] xl:left-[-108px] xl:bottom-[-85px]
                        lg:w-[220px] lg:left-[-74px] lg:bottom-[-37px]
                        md:w-[300px] md:right-[-33px] md:bottom-[-291px]
                        sm:w-[300px] sm:right-[-33px] sm:bottom-[-291px]">
                </div>
                <div class="grd grid-cols-[1fr_1fr] block sm:hidden mt-3">
                    <div class="flex justify-end pe-12 py-6">
                        <img src="{{asset('images/wish-tree/logo.png')}}" alt="" class="w-[130px] xl:w-[180px]">
                    </div>
                    <div class="flex justify-start border-s-2 border-[#9F9F9F] ps-12 py-6">
                        <img src="{{asset('images/wish-tree/logo-usta.png')}}" alt="" class="w-[153px] xl:w-[212px]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const textareas = document.querySelectorAll('.myTextarea');

    textareas.forEach(textarea => {
        const remainingCharsSpan = textarea.parentElement.querySelector('.remainingChars');
        const maxChars = textarea.getAttribute('maxlength');

        textarea.addEventListener('input', () => {
            const currentLength = textarea.value.length;
            remainingCharsSpan.textContent = `${currentLength}/${maxChars}`;
        });


    });

    // для показа начальных значений, когда страница загрузится
    window.addEventListener('DOMContentLoaded', () => {
        textareas.forEach(textarea => {
            const remainingCharsSpan = textarea.parentElement.querySelector('.remainingChars');
            const maxChars = textarea.getAttribute('maxlength');
            const initialLength = textarea.value.length;
            remainingCharsSpan.textContent = `${initialLength}/${maxChars}`;
        });
    });

    function showSuccessNotification() {
        Swal.fire({
            icon: 'success',
            title: 'Успешно!',
            text: 'Письмо отправленно.',
            confirmButtonColor: '#820000',
        });
    }

    const urlParams = new URLSearchParams(window.location.search);

    // Проверяем наличие параметра 'success' со значением 1
    if (urlParams.get('success') === '1') {
        showSuccessNotification();
        const btn = document.querySelector('.swal2-confirm');
        btn.addEventListener('click', function () {
//            window.location.href = 'index.html';
        });
    }
</script>
<style>
    .swal2-confirm {
        box-shadow: none !important;
    }

    #charCount, #charCount2 {
        margin-top: -15px;
    }

    .wrapp {
        width: 100%;
        min-height: 565px;
        background-size: 100% 100%;
    }

    .textarea-with-lines {
        position: relative;
        overflow-y: auto;
        line-height: 33px;
    }

    textarea::-webkit-scrollbar {
        width: 5px;
    }

    textarea::-webkit-scrollbar-track {
        background: transparent;

    }

    textarea::-webkit-scrollbar-thumb {
        background-color: #820000;
        border-radius: 20px;
        border: 3px solid #820000;
    }

    .textarea-with-lines textarea {
        outline: none;
        font-size: 20px;
        width: 100%;
        height: 105px;
        border-bottom: 2px dotted #ccc;
        padding: 10px;
        resize: none;
        font-family: sans-serif;
    }

    .line-underline {
        position: absolute;
        left: 0;
        height: 1px;
        background-image: linear-gradient(to right, transparent, #000, transparent);
        background-size: 100% 2px;
        background-repeat: repeat;
        background-position: 0 0;
        pointer-events: none;
    }

    .line-underline-1, .line-underline-2, .line-underline-3 {
        top: 39px;
        width: 100%;
    }

    .line-underline-2 {
        top: 72px;
    }

    .line-underline-3 {
        top: 94px;
    }

    .line-underline-1, .line-underline-2 {
        background-color: transparent;
        height: 2px;
        background-image: repeating-linear-gradient(to right, #ccc 0, #ccc 2px, transparent 2px, transparent 4px);
    }

    @media screen and (max-width: 643px) {
        .ball-note {
            width: 220px;
            right: 0px;
            top: 15px;
        }
    }

    @media screen and (max-width: 440px) {
        * {
            input, textarea, select {
                font-size: 14px !important;
            }

            h2 {
                font-size: 27px !important;
            }

            .text-area-box {
                width: 100% !important;
            }

            .gap-6 {
                gap: 10px !important;
            }

            .wrapp {
                background-image: url({{asset('images/wish-tree/border-mob.png')}}) !important;
            }
        }
    }
</style>
</body>
</html>
