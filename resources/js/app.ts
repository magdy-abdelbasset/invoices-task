// import genratePdf from './pdf.js';
// import './bootstrap';
import 'flowbite';
import './bootstrap.js'
import * as Dashboard from './dashboard.js'
window.Dashboard = Dashboard
// import filter_data from './filter';
import modalAction from './modal.js';
// import crud from './crud.js';
// import modalEditAction from './modalEdit.js';
// import paginationApi from './pagination-api.js';
// // import Datepicker from 'flowbite-datepicker/Datepicker';
// import { sendApiRequest, sendPostApiRequest } from './utils.js';
// import { Modal } from 'flowbite';
// import Chart from './chart.js';
// new modalAction("#popup-modal")
// new Chart("line-chart",2)
// const circle_1 = new Chart("chart-circle-1",3)
// const circle_2 = new Chart("chart-circle-2",3)
// const circle_3 = new Chart("chart-circle-3",3)
// document.querySelectorAll(".li-days").forEach(el=>{
//     el.addEventListener("click",function(e){
//         switch (el.getAttribute("data-id")) {
//             case "chart-circle-1":
//                 circle_1.update(el)
//                 break;
//             case "chart-circle-2":
//                 circle_2.update(el)

//                 break;
//             case "chart-circle-3":
//                 circle_3.update(el)                
//                 break;
//             default:
//                 break;
//         } 
        
//     })
    
// })
// // TODO: Add SDKs for Firebase products that you want to use
// // https://firebase.google.com/docs/web/setup#available-libraries

// // Your web app's Firebase configuration
// // For Firebase JS SDK v7.20.0 and later, measurementId is optional
// const firebaseConfig = {
//     apiKey: "AIzaSyDdenuFtw6Yj1MQdy_HaNzwUg3mqrmbTyE",
//     authDomain: "bnoni-sway.firebaseapp.com",
//     projectId: "bnoni-sway",
//     storageBucket: "bnoni-sway.appspot.com",
//     messagingSenderId: "122181865831",
//     appId: "1:122181865831:web:2e66bcb7a95f4119a31fc2",
//     measurementId: "G-V26NMZ1L04"
// };


// const filter_d = new filter_data(".close-filter")

window.modalPopUp = new modalAction(".modal-popup");
// new modalAction(".modal-drawer", "data-drawer-target");
// if (document.querySelector("#crud-modal form") !== null) {
//     const crudObj = new crud()
//     window.draweCrudModal = new modalEditAction(".modal-crud", crudObj);
// }
// if (document.querySelector("#drawer-right form") !== null) {

//     const crudObjDrawer = new crud("#drawer-right form")
//     window.draweCrudModal = new modalEditAction(".drawer-crud", crudObjDrawer, "data-drawer-target", ["active", "special"]);


// }

// new paginationApi(null).load1("loading-posts")
// new paginationApi(null).load1("loading-certificates")
// new paginationApi(null).load1("loading-chat")

// new paginationApi(null).load1("loading-rooms")
// new paginationApi(document.getElementById("loading-likes-users")?.getAttribute("data-url")).load1("loading-likes-users", ["post_id"], 0)
// new paginationApi(document.getElementById("loading-views-users")?.getAttribute("data-url")).load1("loading-views-users", ["post_id"], 0)
// new paginationApi(document.getElementById("loading-comments-users")?.getAttribute("data-url")).load1("loading-comments-users", ["post_id"], 0)
// new paginationApi(null).load1("loading")
// new paginationApi(document.getElementById("loading-reports-users")?.getAttribute("data-url")).load1("loading-reports-users", ["post_id"], 0)
// let chatUserPagination = new paginationApi(document.getElementById("loading-chat-users")?.getAttribute("data-url"));
// window.pageApi = new paginationApi(document.getElementById("loading-chat-messages")?.getAttribute("data-url"));
// window.pageApi.load1("loading-chat-messages", ["user_id"], 0)
// chatUserPagination.load1("loading-chat-users", ['search_user'], 0)
// const elm = document.querySelector(`[data-drawer-target=drawer-right-likes]`);
// const element = document.querySelector(`[name=post_id]`) as HTMLInputElement;

// if (elm != null) {

//     elm?.addEventListener("click", (x) => {
//         element.value = elm.getAttribute("data-post_id") as string;
//     })
// }

// const elm2 = document.querySelector(`[data-drawer-target=drawer-right-views]`) as HTMLInputElement;
// if (elm2 != null) {

//     elm2.addEventListener("click", (x) => {
//         element.value = elm2.getAttribute("data-post_id") as string;
//     })
// }
// const elm3 = document.querySelector(`[data-drawer-target=drawer-right-comments]`) as HTMLInputElement;

// if (elm3 != null) {
//     elm3.addEventListener("click", (x) => {
//         element.value = elm3.getAttribute("data-post_id") as string;
//     })

// }
// const elm4 = document.querySelector(`[data-drawer-target=drawer-right-reports]`) as HTMLInputElement;

// if (elm4 != null) {
//     elm4.addEventListener("click", (x) => {
//         element.value = elm4.getAttribute("data-post_id") as string;
//     })

// }
// let objDiv = document.getElementById("messages-container") as HTMLElement
// if (objDiv != null) {

//     objDiv.scrollTop = objDiv.scrollHeight;
// }
// let userIdInput = document.querySelector(`[name=user_id]`) as HTMLInputElement;
// let questionIdInput = document.querySelector(`[name=ask_expert_id]`) as HTMLInputElement;
// let roomIdInput = document.querySelector(`[name=room_id]`) as HTMLInputElement;
// let FileIdInput = document.querySelector(`[name=file]`) as HTMLInputElement;
// let sendInput = document.getElementById("send-input") as HTMLInputElement
// if (sendInput != null) {

//     sendInput.addEventListener("keyup", (event) => {
//         event.preventDefault();

//         if (event.keyCode === 13) {
//             var data = new FormData()
//             data.append('file', FileIdInput.files[0])
//             if(questionIdInput != null){
                
//                 data.append('ask_expert_id', questionIdInput.value)
//             }else if(userIdInput != null){

//                 data.append('user_id', userIdInput.value)
//             }else{
//                 data.append('room_id', roomIdInput.value)

//             }
//             data.append('message', event.target?.value)
//             sendPostApiRequest(sendInput.getAttribute("data-url")
//                 , data).then((res) => {
//                     res.json().then(d => {
//                         // objDiv.insertAdjacentHTML("beforeend", d.data.html)
//                         // objDiv.scrollTop = objDiv.scrollHeight;
//                         // sendInput.value ='';

//                     })

//                 })
//         }
//     })
// }
// let searchInput = document.getElementById("search_user") as HTMLInputElement
// let objDiv2 = document.getElementById("users-container") as HTMLElement


// if (searchInput != null) {

//     searchInput.addEventListener("keyup", (event) => {
//         event.preventDefault();
//         let value = event.target?.value;
//         if (event.keyCode === 13) {

//             sendPostApiRequest(searchInput.getAttribute("data-url")
//                 , {
//                     search_user: value,
//                 }).then((res) => {
//                     res.json().then(d => {
//                         let divUsers = document.querySelectorAll(".user_div");
//                         divUsers.forEach(e => e.remove())
//                         chatUserPagination.setPage('2');
//                         chatUserPagination.add_param('search_user', value)
//                         objDiv2.insertAdjacentHTML("beforeend", d.data.html)
//                         window.pageApi.load_add_event_custom()
//                     })

//                 })
//         }
//     })
// }

// let modals_data = document.querySelectorAll(".data-modal")
// const modal_data = document.getElementById("data-modal");
// if(modal_data != null){

//     const modal_obj = new Modal(modal_data);
// }

// modals_data.forEach(modal => {
//     modal.addEventListener("click", function (event) {
//         let url = this.getAttribute("data-url")
//         sendApiRequest(url).then(reponse => {
//             reponse.json().then(data => {
//                 let elm = document.querySelector("#data-modal .content") as HTMLElement;
//                 if (elm != null) {
//                     elm.innerHTML = data.data.html
//                     modal_obj.show();

//                 }

//             })
//         })
//     })
// })

// const datepickerEls = document.querySelectorAll('.datepicker');
// Datepicker.locales.ar = {
//     days: ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت", "الأحد"],
//     daysShort: ["أحد", "اثنين", "ثلاثاء", "أربعاء", "خميس", "جمعة", "سبت", "أحد"],
//     daysMin: ["ح", "ن", "ث", "ع", "خ", "ج", "س", "ح"],
//     months: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
//     monthsShort: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
//     today: "هذا اليوم",
//     rtl: true
// };
// datepickerEls.forEach(el => {
//     console.log(Datepicker.locales)
//     new Datepicker(el, {
//         language: "ar",
//         locale: "ar",
//         format: "y-m-d"
//     });
// })


document.querySelectorAll(".li-side-tabs a").forEach((el )=>{
    el.addEventListener("click",(e=>{
        let active = el.classList.contains("active")
        if(!active){
            document.querySelectorAll(".li-side-tabs a").forEach((el2 )=>{
                el2.classList.remove("text-white","bg-blue-700","active","dark:bg-blue-600")
                el2.classList.add("hover:text-gray-900","bg-gray-50","hover:bg-gray-100","dark:bg-gray-800","dark:hover:bg-gray-700","dark:hover:text-white")
                el2.querySelector("object")?.setAttribute("data",el2?.getAttribute("data-icon")) 
            });
            e.target?.querySelector("object")?.setAttribute("data",el?.getAttribute("data-iconactive"))
            e.target?.classList.add("text-white","bg-blue-700","active","dark:bg-blue-600")
            e.target?.classList.remove("hover:text-gray-900","bg-gray-50","hover:bg-gray-100","dark:bg-gray-800","dark:hover:bg-gray-700","dark:hover:text-white")
            
        }
    }))
})

document.querySelectorAll("[data-target-tab]").forEach((el )=>{
    el.addEventListener("click",(e=>{
        document.querySelectorAll(".tab-content").forEach((el2 )=>{
            el2.classList.add("hidden")
        });
        document.querySelector(e.target?.getAttribute("data-target-tab"))?.classList.remove("hidden")
    }))
})


document.querySelectorAll("[target-top-tab]").forEach((el )=>{
    el.addEventListener("click",(e=>{
        document.querySelectorAll(".top-tab-content > div").forEach((el2 )=>{
            el2.classList.add("hidden")
        });
        document.querySelector(e.target?.getAttribute("target-top-tab"))?.classList.remove("hidden")
        document.querySelectorAll("[target-top-tab]").forEach((el3 )=>{
            el3.className = "inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300"
        });
        e.target.className = "inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500"
    }))
})