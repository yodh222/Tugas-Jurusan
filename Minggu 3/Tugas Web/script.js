// window.addEventListener("scroll",function(){
//     const nav = document.getElementById("navbar");
//     console.log(window.scrollY);
//     if (window.scrollY > 89){
//         nav.style.backgroundColor = "#242424"; // Ganti warna latar belakang saat navbar menempel
//     }else{
//         nav.style.backgroundColor = "#494949";
//     }
// });
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: "smooth",
            });
        }
    });
});