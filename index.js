
let subMenu = document.getElementById("subMenu");
// function toggleMenu(){
//     subMenu.classList.toggle("menuwrpopen");
// }

let hj = document.querySelector('.user-pic');
hj.addEventListener('click', function(){
    console.log("clicked")
    subMenu.classList.toggle("menuwrpopen");
})
