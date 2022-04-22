let menu = document.getElementById('toggle-menu')
let sidebar = document.querySelector('.sidebar');
let main = document.querySelector('.main')
let header= document.querySelector('.header')
//Modal
const topbar = document.getElementById('top-bar')
const editUser = document.getElementById('edit')
const deleteUser = document.getElementById('delete')
const viewUser = document.getElementById('view')
const modal = document.getElementById('modal')

const searchText = document.getElementById('search-text');

menu.addEventListener('click',()=>{
    sidebar.classList.toggle('active');
    main.classList.toggle('active')
    header.classList.toggle('active')
    console.log("holaaa");
})

// if(contentUser){
//     contentUser.addEventListener('click',(e)=>{
//         console.log(e);
//     })
// }
/*
topbar.addEventListener('click',(e)=>{
    if(e.target.classList.contains('fa-plus')){
        modal.classList.toggle('lightBox--show')
    }
})
*/

main.addEventListener('click',(e)=>{
    console.log(e);
    if(e.target.classList.contains('fa-pen')){
       // modal.classList.toggle('lightBox--show')
    }else if(e.target.classList.contains('fa-trash')){
       // modal.classList.toggle('lightBox--show')
    }else if(e.target.classList.contains('fa-eye')){
       // modal.classList.toggle('lightBox--show')
    }
})

if(modal){
    modal.addEventListener('click',(e)=>{
        if(e.target.classList.contains('lightBox')){
            modal.classList.toggle('lightBox--show')
        }
    })
}
    
let allnames = Array.from(document.querySelectorAll('[data-name]'));
console.log(allnames);

searchText.addEventListener('keyup',(e)=>{
    let valor = searchText.value.toUpperCase();;
    for (const name of allnames) {
        if(name.dataset.name.toUpperCase().indexOf(valor)==-1){
            name.parentElement.style.display = 'none';
        }else{
            name.parentElement.style.display = 'grid';
        }
    }
    console.log(valor);
})