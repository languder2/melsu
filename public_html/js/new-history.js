function disableBodyScroll() {
    document.body.style.overflow = 'hidden';
    document.body.style.paddingRight = '5px';
}

function enableBodyScroll() {
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
}

function scrollToYearAndClose(itemId) {
    const popover = document.getElementById('all-years');
    if (popover) {
        popover.hidePopover();
    }
    
    setTimeout(() => {
        scrollToBlockHistory('block-' + itemId);
    }, 100);
}

function getGroupByYear(year) {
    const currentYear = new Date().getFullYear();
    if (year >= 2001) return currentYear.toString();
    if (year >= 1951) return '2000';
    if (year >= 1901) return '1950';
    if (year >= 1851) return '1900';
    if (year >= 1801) return '1850';
    if (year >= 1751) return '1800';
    if (year >= 1701) return '1750';
    return 'До 1750';
}
function initScrollObserver() {
    const groupLinks = document.querySelectorAll('.group-link');
    const blocks = document.querySelectorAll('.parallax-bg');
    
    const observer = new IntersectionObserver((entries) => {
        let visibleBlock = null;
        
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!visibleBlock || entry.intersectionRatio > visibleBlock.intersectionRatio) {
                    visibleBlock = entry;
                }
            }
        });
        
        if (visibleBlock) {
            const block = visibleBlock.target;
            const yearElement = block.querySelector('.date-overlay');
            if (yearElement) {
                const currentYear = parseInt(yearElement.textContent.trim());
                const activeGroup = getGroupByYear(currentYear);
                
                groupLinks.forEach(link => {
                    if (link.getAttribute('data-group') === activeGroup) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        }
    }, {
        threshold: [0.1, 0.5, 0.9],
        rootMargin: '-30% 0px -30% 0px'
    });
    
    blocks.forEach(block => {
        observer.observe(block);
    });
}

function scrollToBlockHistory(blockId) {
    const element = document.getElementById(blockId);
    if (element) {
        let offset;
        const screenWidth = window.innerWidth;
        
        if (screenWidth < 768) {
            offset = 90;
        } else if (screenWidth < 1024) {
            offset = 90;
        } else {
            offset = 150;
        }
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}

function scrollToNext() {
    const blocks = Array.from(document.querySelectorAll('.parallax-bg'));
    const currentScroll = window.pageYOffset;
    
    let currentIndex = -1;
    let minDistance = Infinity;
    
    blocks.forEach((block, index) => {
        const distance = Math.abs(block.offsetTop - currentScroll);
        if (distance < minDistance) {
            minDistance = distance;
            currentIndex = index;
        }
    });
    
    if (currentIndex < blocks.length - 1) {
        scrollToBlockHistory(blocks[currentIndex + 1].id);
    }
}

function scrollToPrevious() {
    const blocks = Array.from(document.querySelectorAll('.parallax-bg'));
    const currentScroll = window.pageYOffset;
    
    let currentIndex = -1;
    let minDistance = Infinity;
    
    blocks.forEach((block, index) => {
        const distance = Math.abs(block.offsetTop - currentScroll);
        if (distance < minDistance) {
            minDistance = distance;
            currentIndex = index;
        }
    });
    
    if (currentIndex > 0) {
        scrollToBlockHistory(blocks[currentIndex - 1].id);
    }
}

function scrollToElementWithOffset(element, offset) {
    if (element) {
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}

window.Scrolls = {
    scrollToElementWithOffset: function(element, offset) {
        scrollToElementWithOffset(element, offset);
    }
};
document.addEventListener('DOMContentLoaded', function() {
    const popover = document.getElementById('all-years');
    
    popover.addEventListener('toggle', function(event) {
        if (event.newState === 'open') {
            disableBodyScroll();
        } else {
            enableBodyScroll();
        }
    });

    initScrollObserver();
    document.querySelector('.my-6').style.display = 'none';
    document.querySelector('.flex.gap-4.mb-6').classList.remove('mb-6');
    document.querySelector('.main-content').style.padding = '0px';
});