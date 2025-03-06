document.addEventListener('DOMContentLoaded',()=>{
    const scrollToTopBtn = document.querySelector(".scroll-to-top-box");

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
    function toggleScrollToTopBtn() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.opacity = "1";
        } else {
            scrollToTopBtn.style.opacity = "0";
        }
    }
    window.addEventListener("scroll", toggleScrollToTopBtn);

    scrollToTopBtn.addEventListener("click", scrollToTop);
})
