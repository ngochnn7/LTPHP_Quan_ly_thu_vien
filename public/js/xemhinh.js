const modal = document.querySelector(".show-img");
const previews = document.querySelectorAll(".hact img");
const original = document.querySelector(".full");

previews.forEach(preview => {
    preview.addEventListener('click',()=>{
        modal.classList.add("open");
        original.classList.add("open");
        const originalsrc = preview.getAttribute("data-original");
        original.src =`./public/anhchitiet_sach/${originalsrc}`;
    });
});

modal.addEventListener('click',(e)=>{
if(e.target.classList.contains("show-img")){
    modal.classList.remove('open');
    original.classList.remove("open");
}
});
