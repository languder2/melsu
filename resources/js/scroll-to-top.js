document.addEventListener('DOMContentLoaded',()=>{
    const scrollToTopBtn = document.querySelector(".scroll-to-top-box");
    const applyButton = document.querySelector(".apply-online-button");
    console.log(applyButton)

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }
    function toggleScrollToTopBtn() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.opacity = "1";
            applyButton.classList.add('scroll');

        } else {
            scrollToTopBtn.style.opacity = "0";
            applyButton.classList.remove('scroll');
        }
    }
    window.addEventListener("scroll", toggleScrollToTopBtn);

    scrollToTopBtn.addEventListener("click", scrollToTop);
})
