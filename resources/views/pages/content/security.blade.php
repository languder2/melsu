<section class="flex flex-col gap-4">

    <h4 class="font-semibold text-2xl">
        Документы
    </h4>

    <div class="bg-white py-3 px-4">
        <ul class="flex flex-col gap-3 list-disc ml-4 ">
            <li>
                <a
                    href="{{ Storage::url('documents/department-of-internal-control-and-access-control/The position of the pass-through and the internal object MelSU.pdf') }}"
                    target="_blank"
                    class="underline hover:text-red-base"
                >
                    Положение о пропускном и внутриобъектовом режиме ФГБОУ ВО "Мелитопольский государственный университет"
                </a>
            </li>
            <li>
                <a
                    href="{{ Storage::url('documents/security-and-regime-management/order-102.pdf') }}"
                    target="_blank"
                    class="underline hover:text-red-base"
                >
                    Приказ о запрете проноса оружия и взрывоопасных веществ на территорию ФГБОУ ВО «Мелитопольский государственный университет»
                </a>
            </li>
            <li>
                <a
                    href="{{ Storage::url('Instructions on the procedure of actions during evacuation in case of terrorist threat, armed attack and other emergency situations of students, teachers, employees, visitors of the Federal State budgetary edu.pdf') }}"
                    target="_blank"
                    class="underline hover:text-red-base"
                >
                    Инструкция о порядке действий во время эвакуации при террористической угрозе, вооруженном нападении и иных чрезвычайных ситуациях обучающихся, преподавателей, работников, посетителей федерального государственного бюджетного образовательного учреждения высшего образования «Мелитопольский государственный университет»
                </a>
            </li>
            <li>
                <a
                    href="{{ Storage::url('documents/security-and-regime-management/Instructions (algorithms) for actions in case of emergencies.pdf') }}"
                    target="_blank"
                    class="underline hover:text-red-base"
                >
                    Инструкция (алгоритмы) по действиям при возникновении чрезвычайных ситуаций
                </a>
            </li>
        </ul>
    </div>

    <div></div>

    <x-events.list-by-category
        category="security"
    />

</section>


