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


