// let category = document.querySelector('#last-ads')
// let navbar = document.querySelector('#navbar')

// window.addEventListener('scroll' , () => {
//         // console.log('scemo chi legge');
//         if(window.pageYOffset > 580){
//             navbar.classList.add('grad')
//             navbar.classList.remove('bg-blur')

//         }else{
//             navbar.classList.add('bg-blur')
//             navbar.classList.remove('grad')
//         }
// })

let navBtn = document.querySelector('#nav-btn')
let navbarMenu = document.querySelector('#navbarMenu')

navBtn.addEventListener('click', () => {
    navbarMenu.classList.toggle('d-none')
})