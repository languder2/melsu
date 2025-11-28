// document.addEventListener('DOMContentLoaded',()=>{
//     const scrollToTopBtn = document.querySelector(".scroll-to-top-box");
//     const applyButton = document.querySelector(".apply-online-button");
//
//     function scrollToTop() {
//         window.scrollTo({
//             top: 0,
//             behavior: "smooth"
//         });
//     }
//     function toggleScrollToTopBtn() {
//         if (window.pageYOffset > 300) {
//             scrollToTopBtn.style.opacity = "1";
//             applyButton.classList.add('scroll');
//
//         } else {
//             scrollToTopBtn.style.opacity = "0";
//             applyButton.classList.remove('scroll');
//         }
//     }
//     window.addEventListener("scroll", toggleScrollToTopBtn);
//
//     scrollToTopBtn.addEventListener("click", scrollToTop);
// })
//


export function scrollToBlock(blockID){
    const block = document.getElementById(blockID)

    if(!block) return;

    block.scrollIntoView({
        behavior: "smooth"
    })

    const rect = block.getBoundingClientRect();



    console.log(rect.top)

    // window.scrollTo({
    //     top: rect.top - 180,
    //     behavior: "smooth"
    // });

}
