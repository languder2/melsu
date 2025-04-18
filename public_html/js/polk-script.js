document.addEventListener('DOMContentLoaded', function() {
    const leftSideMenuLinks = document.querySelectorAll('.left-side-menu a[href^="#"]');
    const accordionBoxes = document.querySelectorAll('.accordion-box');
    const offset = -180;
    const personCards = document.querySelectorAll('.accordion-box');
    const firstLettersContainer = document.getElementById('firstLetters');
    const resetBtn = document.querySelector('.reset');
    let firstLetters = [];
    let activeLetterButton = null;

    function openAccordion(accordionBox) {
        accordionBoxes.forEach(box => {
            if (box.classList.contains('show')) {
                let toggleButn = box.querySelector('.accordion-toggle');
                toggleButn.click();
            }
        });
        const toggleButton = accordionBox.querySelector('.accordion-toggle');
        if (toggleButton && !accordionBox.classList.contains('show')) {
            toggleButton.click();
        }
    }

    function reset() {
        resetBtn.classList.add('active');
        if (activeLetterButton) {
            activeLetterButton.classList.remove('active');
            activeLetterButton = null;
        }
        accordionBoxes.forEach(box => {
            if (box.classList.contains('show')) {
                let toggleButn = box.querySelector('.accordion-toggle');
                toggleButn.click();
            }
        });
        personCards.forEach(card => {
            card.style.display = 'block';
        });
    }

    leftSideMenuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            reset();
            event.preventDefault();

            const targetId = this.getAttribute('href').substring(1);
            const targetAccordion = document.getElementById(targetId);

            if (targetAccordion) {
                setTimeout(() => {
                    openAccordion(targetAccordion);
                    const targetPosition = targetAccordion.getBoundingClientRect().top + window.scrollY + offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }, 500);
            } else {
                console.error(`Аккордеон с id "${targetId}" не найден.`);
            }
        });
    });


    personCards.forEach(card => {
        const nameElement = card.querySelector('h5');
        if (nameElement && nameElement.textContent.trim() !== '') {
            firstLetters.push(nameElement.textContent.trim()[0].toUpperCase());
        }
    });

    const uniqueSortedLetters = [...new Set(firstLetters)].sort();

    uniqueSortedLetters.forEach(letter => {
        const linkElement = document.createElement('span');
        linkElement.textContent = letter;
        linkElement.className = "letter-button";
        linkElement.addEventListener('click', function(event) {
            accordionBoxes.forEach(box => {
                if (box.classList.contains('show')) {
                    let toggleButn = box.querySelector('.accordion-toggle');
                    toggleButn.click();
                }
            });
            event.preventDefault();
            filterByFirstLetter(letter);

            resetBtn.classList.remove('active');
            if (activeLetterButton) {
                activeLetterButton.classList.remove('active');
            }
            this.classList.add('active');
            activeLetterButton = this;
        });
        firstLettersContainer.appendChild(linkElement);
        firstLettersContainer.appendChild(document.createTextNode(' '));
    });

    resetBtn.addEventListener('click', (e) => {
        reset();
    });

    function filterByFirstLetter(letter) {
        personCards.forEach(card => {
            const nameElement = card.querySelector('h5');
            if (nameElement && nameElement.textContent.trim()[0].toUpperCase() === letter) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    const initialHash = window.location.hash;
    if (initialHash) {
        const targetId = initialHash.substring(1);
        const targetAccordionOnLoad = document.getElementById(targetId);

        if (targetAccordionOnLoad) {
            setTimeout(() => {
                openAccordion(targetAccordionOnLoad);
                const targetPosition = targetAccordionOnLoad.getBoundingClientRect().top + window.scrollY + offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }, 150);
        }
    }
});
