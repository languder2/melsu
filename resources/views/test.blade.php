<div class="flex items-center">
    <input type="checkbox" id="myCheckbox" class="hidden">
    <label for="myCheckbox" class="flex items-center">
        <div class="w-6 h-6 border border-gray-300 rounded-md mr-2">
            <svg class="w-4 h-4 hidden" id="checkIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <span>Текст рядом с чекбоксом</span>
    </label>
</div>

<div id="myBlock" class="hidden">
    Этот блок будет скрыт, пока чекбокс не выбран.
</div>

<script>
    const checkbox = document.getElementById('myCheckbox');
    const block = document.getElementById('myBlock');
    const checkIcon = document.getElementById('checkIcon');

    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            block.classList.remove('hidden');
            checkIcon.classList.remove('hidden');
        } else {
            block.classList.add('hidden');
            checkIcon.classList.add('hidden');
        }
    });
</script>
