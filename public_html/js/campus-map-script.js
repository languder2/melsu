const modelViewerColor = document.querySelector("model-viewer.uppermap");
let rotationAngle = 0;
let isRotating = true;
let animation;
const speed = 0.002;
let currentRotation = 0;
let currentRotationDeg = 0;
let isModelClickable = true;
const defaultTarget = '-1004.9174942041682m 30.16798973083496m -286.1300614749389m';
const observer = new MutationObserver(mutations => {
    mutations.forEach(mutation => {
        if (mutation.attributeName === 'camera-orbit') {
            // Значение атрибута `camera-orbit` изменилось
            const newOrbit = mutation.target.getAttribute('camera-orbit');
        }
    });
});
// Начинаем наблюдение за изменениями в `model-viewer`
observer.observe(modelViewerColor, { attributes: true, attributeFilter: ['camera-orbit'] });
function resetRotation() {
    rotationAngle = 0;
    currentRotation = 0;
    currentRotationDeg = 0;
}
function rotateModel() {
    if (isRotating) { // Проверяем, включена ли вращение
        rotationAngle += speed; // Изменяйте значение для регулировки скорости вращения
        modelViewerColor.cameraOrbit = `${rotationAngle}rad 0 0`;
        animation = requestAnimationFrame(rotateModel);
        currentRotation = rotationAngle;
        currentRotationDeg = (currentRotation * 180) / Math.PI;
    }
}
function stopRotation() {
    isRotating = false;
}
modelViewerColor.addEventListener('load', () => {
    let numberCorp = 0;
    let targetCoords = 0;
    const selectElement = document.querySelector('.select-korp .form-select');
    const prvBtn = document.querySelector('.prvBtn');
    const nxtBtn = document.querySelector('.nxtBtn');

    const options = Array.from(selectElement.options);
    let selectedIndex = 0; // Начальный индекс (первый элемент)


    const values = [];
// Перебираем все элементы option внутри select
    for (const option of selectElement.options) {
        // Добавляем значение атрибута value в массив
        values.push(option.value);
    }

    // Получаем начальное значение выбранного элемента
    let selectedValue = selectElement.value;

    // Выводим начальное значение в консоль


    const buttons = document.querySelectorAll('model-viewer.uppermap button.Hotspot');
    const crosses = document.querySelectorAll('.card .close');
    let descrip = document.querySelectorAll('model-viewer.uppermap button.Hotspot');
    let selectBtn = document.querySelector('.select-korp');
    let resetBtn = document.querySelector('.reset-map');
    let cards = document.querySelectorAll('.card');
    const defaulColor = '#E7E7E7';
    const colorString = '#820000';
    const model = modelViewerColor.model;

    function resetMap(){
        stopRotation();
        rotationAngle = 0;
        currentRotation = 0;
        currentRotationDeg = 0;
        selectElement.value = 0;
        modelViewerColor.setAttribute('camera-orbit', `90deg 65deg 2897m`);
        modelViewerColor.setAttribute('field-of-view', '50deg');
        modelViewerColor.setAttribute('camera-target', defaultTarget);
        modelViewerColor.setAttribute('camera-controls',"");
        model.materials.slice(2).forEach((num, index) => {
            const material = model.materials[2 + index];
            material.pbrMetallicRoughness.setBaseColorFactor(defaulColor);
        });
        descrip.forEach((e)=>{
            e.style.display = 'block';
        });
        cards.forEach(card => {
            card.style.display = 'none';
        });
    }

    buttons.forEach(button => {
        button.addEventListener('click', (event) => {

            numberCorp = button.dataset.number;
            targetCoords = button.dataset.position;

            model.materials.slice(2).forEach((num, index) => {
                if (index == numberCorp) {
                    selectElement.value = numberCorp;
                    const material = model.materials[numberCorp];
                    material.pbrMetallicRoughness.setBaseColorFactor(colorString);
                    modelViewerColor.setAttribute('camera-target', targetCoords);
                    modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 63deg 1000m`);
                    modelViewerColor.setAttribute('field-of-view', '10deg');
                    modelViewerColor.setAttribute('camera-controls', 'none');
                    modelViewerColor.removeAttribute('camera-controls');
                    cards.forEach(card => {
                        if(numberCorp == card.dataset.number) {
                            card.style.display ='flex';
                            resetBtn.style.display = 'block';
                        }
                        else{
                            card.style.display = 'none';
                        }
                    });
                }
                const material = model.materials[2 + index];
                material.pbrMetallicRoughness.setBaseColorFactor(defaulColor);
            });

            if(numberCorp == 2){
                const material = model.materials[24];
                material.pbrMetallicRoughness.setBaseColorFactor(colorString);
            }


// Получение материала с индексом 1 (считая с нуля)
            if  (numberCorp == 17 || numberCorp == 18 || numberCorp == 19 || numberCorp == 20 || numberCorp == 21 || numberCorp == 22 || numberCorp == 23) {
                modelViewerColor.setAttribute('camera-target', targetCoords);
                modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 63deg 1000m`);
                modelViewerColor.setAttribute('field-of-view', '10deg');

                cards.forEach(card => {
                    if(numberCorp == card.dataset.number) {
                        card.style.display ='flex';
                    }
                    else{
                        card.style.display = 'none';
                    }
                });
            }

// Установка цвета материала
            const material = model.materials[numberCorp];
            material.pbrMetallicRoughness.setBaseColorFactor(colorString);

            crosses.forEach(event =>{
                event.addEventListener('click', (e) => {
                    selectElement.value = 0;
                    selectBtn.style.display = 'flex';
                    stopRotation();
                    modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 65deg 2897m`);
                    modelViewerColor.setAttribute('field-of-view', '50deg');
                    modelViewerColor.setAttribute('camera-target', button.dataset.position);
                    modelViewerColor.setAttribute('camera-controls',"");
                    model.materials.slice(2).forEach((num, index) => {
                        const material = model.materials[2 + index];
                        material.pbrMetallicRoughness.setBaseColorFactor(defaulColor);
                    });
                    descrip.forEach((e)=>{
                        e.style.display = 'block';
                    });
                    cards.forEach(card => {
                        card.style.display = 'none';
                    });
                });
            });

            if (button.closest('model-viewer.uppermap button.Hotspot') != null){
                isRotating = true;
                rotateModel();
                descrip.forEach((e)=>{
                    e.style.display = 'none';
                });
            }
            /*let a = document.querySelector(`model-viewer.uppermap button[data-number="${numberCorp}"]`);*/
            modelViewerColor.addEventListener('click', event => {

                if (isModelClickable) {

                } else {

                    event.stopPropagation();
                }
            });
        });
    });
    function changeSelected(direction) {
        const currentIndex = options.indexOf(selectElement.selectedOptions[0]);
        selectedIndex = (currentIndex + direction + options.length) % options.length;
        // Установка индекса на последний элемент только при сдвиге влево
        if (selectedIndex === 0 && direction === -1) {
            selectedIndex = options.length - 1;
        }

// Проверяем, что перешли на 0 и если да, то переключаем на следующий индекс (пропускаем 0)
        if (selectedIndex === 0) {
            selectedIndex = 1;
        }
        // Устанавливаем новое выбранное значение
        selectElement.selectedIndex = selectedIndex;
        selectedValue = options[selectedIndex].value;
        resetRotation();
        changeSelect();
    }
    function changeSelect() {
        cancelAnimationFrame(animation);
        selectedValue = selectElement.value;
        buttons.forEach(button =>{
            if(selectedValue == button.dataset.number){
                numberCorp = button.dataset.number;
                targetCoords = button.dataset.position;
            }
        });
        model.materials.slice(2).forEach((num, index) => {
            if (selectedValue == numberCorp) {
                const material = model.materials[numberCorp];
                material.pbrMetallicRoughness.setBaseColorFactor(colorString);
                modelViewerColor.setAttribute('camera-target', targetCoords);
                modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 63deg 1000m`);
                modelViewerColor.setAttribute('field-of-view', '10deg');
                modelViewerColor.setAttribute('camera-controls', 'none');
                modelViewerColor.removeAttribute('camera-controls');
                cards.forEach(card => {
                    if(numberCorp == card.dataset.number) {
                        card.style.display ='flex';
                        resetBtn.style.display = 'block';
                    }
                    else{
                        card.style.display = 'none';
                    }
                });
            }
            const material = model.materials[2 + index];
            material.pbrMetallicRoughness.setBaseColorFactor(defaulColor);
        });

        if (numberCorp == 2){
            const material = model.materials[24];
            material.pbrMetallicRoughness.setBaseColorFactor(colorString);
        }

        if  (numberCorp == 17 || numberCorp == 18 || numberCorp == 19 || numberCorp == 20 || numberCorp == 21 || numberCorp == 22 || numberCorp == 23) {
            modelViewerColor.setAttribute('camera-target', targetCoords);
            modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 63deg 1000m`);
            modelViewerColor.setAttribute('field-of-view', '10deg');

            cards.forEach(card => {
                if(numberCorp == card.dataset.number) {
                    card.style.display ='flex';
                }
                else{
                    card.style.display = 'none';
                }
            });
        }

// Установка цвета материала
        const material = model.materials[numberCorp];
        material.pbrMetallicRoughness.setBaseColorFactor(colorString);

        crosses.forEach(event =>{
            event.addEventListener('click', (e) => {
                selectElement.value = 0;
                selectBtn.style.display = 'flex';
                stopRotation();
                modelViewerColor.setAttribute('camera-orbit', `${currentRotationDeg}deg 65deg 2897m`);
                modelViewerColor.setAttribute('field-of-view', '50deg');
                modelViewerColor.setAttribute('camera-target', targetCoords);
                modelViewerColor.setAttribute('camera-controls',"");
                model.materials.slice(2).forEach((num, index) => {
                    const material = model.materials[2 + index];
                    material.pbrMetallicRoughness.setBaseColorFactor(defaulColor);
                });
                descrip.forEach((e)=>{
                    e.style.display = 'block';
                });
                cards.forEach(card => {
                    card.style.display = 'none';
                });
            });
        });
        if (selectedValue !== "0"){
            resetRotation();
            isRotating = true;
            rotateModel();
            descrip.forEach((e)=>{
                e.style.display = 'none';
            });
        }
        modelViewerColor.addEventListener('click', event => {

            if (isModelClickable) {

            } else {

                event.stopPropagation();
            }
        });


    }
    prvBtn.addEventListener('click', () => {
        changeSelected(-1);
    });
    nxtBtn.addEventListener('click', () => changeSelected(1));
    selectElement.addEventListener('change', () => changeSelect());
    document.querySelector('.reset-map').addEventListener('click',() =>resetMap());
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            resetMap();
        }
    });

});
