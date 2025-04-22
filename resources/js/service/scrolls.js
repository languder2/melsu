export function scrollToElementWithOffset(element, offset = 80) {
    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;

    const offsetPosition = elementPosition - offset;

    window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
    });
}
