function createCounter(elementId, targetValue, interval, step = 1) {
    const counterElement = document.getElementById(elementId);
    let count = 0;
    let intervalId;

    function increment() {
        count += step;
        counterElement.textContent = count;
        if (count >= targetValue) {
            clearInterval(intervalId);
        }
    }

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            intervalId = setInterval(increment, interval);
            observer.unobserve(counterElement); // Останавливаем наблюдение после запуска
        }
    });

    observer.observe(counterElement);
    return intervalId;
}

function createCounterDecay(elementId, startValue, interval, step = 1) {
    const counterElement = document.getElementById(elementId);
    let count = startValue;
    let intervalId;

    function decrement() {
        count -= step;
        counterElement.textContent = count;
        if (count === 1) {
            clearInterval(intervalId);
        }
    }

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            intervalId = setInterval(decrement, interval);
            observer.unobserve(counterElement); // Останавливаем наблюдение после запуска
        }
    });

    observer.observe(counterElement);
    return intervalId;
}

if (document.querySelector('.box-number')) {
    if (document.querySelector('#countFaculty')) {
        const intervalIdFaculty = createCounter('countFaculty', 7, 100, 1);
    }
    if (document.querySelector('#countKaf')) {
        const intervalIdKaf = createCounter('countKaf', 40, 10, 1);
    }
    if (document.querySelector('#countStud')) {
        const intervalIdStud = createCounter('countStud', 15500, 1, 100);
    }
    if (document.querySelector('#countObl')) {
        const intervalIdObl = createCounterDecay('countObl', 100, 1, 1);
    }
    if (document.querySelector('#countProg')) {
        const intervalIdProg = createCounter('countProg', 96, 1, 1);
    }
}
