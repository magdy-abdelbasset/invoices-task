import event_class, { processEvent } from "./event";
import { dic } from "./interfaces";
import Toast from 'awesome-toast-component'
import modalEditAction from "./modalEdit";
import { initModals } from "flowbite";
import instances from 'flowbite/lib/esm/dom/instances';

class crud  {
    private element:HTMLFormElement;
    private selector:string;
    private selector_table:string;
    private formData:FormData;

    private url:string;
    private body:dic={};
    constructor(selector="#crud-modal form",selector_table="table tbody")
    {
        this.selector = selector;
        this.selector_table = selector_table;
        this.element = document.querySelector(selector) as HTMLFormElement;
        this.url = this.element.action;
        this.formData = new FormData(this.element);

        this.add_listen(this);
    }
    private add_listen(params:crud) 
    {
        this.element.addEventListener("submit",(e)=>{
            e.preventDefault();
            this.process()
        })   
    }
    private async process()
    {
        this.formData = new FormData(this.element);
        this.url = this.element.action;

        this.intialDomForm()
        
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') as string;
        const response = await fetch(this.url, {
            headers: {
                accept:"application/json",
                "X-CSRF-TOKEN": token,
            },
            method: "POST",
            body: this.formData,
          });
          if(response.status == 422 ){

              await this.validation(response);
          }else if(response.status == 200){
            if(this.formData.get("_method")=="PATCH")
            {
                var last_segment = this.url.split("/").pop();

                document.getElementById("row-table-"+last_segment)?.remove();
            }
            this.insert_success(response)
            if(this.formData.get("_method")=="POST"){

                this.emptyInputForm()
            }
            new Toast("تم بنجاح 😍",{
                position:'top'
            })
        }


        
    }
    // public async btnClick(btn_selector)
    // {
    //     const element = document.querySelector(btn_selector);
    //     const url = element.getAttribute("data-url");
    //     const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') as string;

    //     element.addEventListener("click",async()=>{
    //         const response = await fetch(url, {
    //             headers: {
    //                 accept:"application/json",
    //                 "X-CSRF-TOKEN": token,
    //             },
    //             method: "POST",
    //           });
    //           if(response.status == 200){
    //             response.json().then((data)=>{
    //                document.querySelector(this.selector)?.innerHTML = data.data as string;
    //             });
    //         }
    //     })

        
    // }
    
    public intialDomForm()
    {
        this.formData.forEach((k,v)=>{
            document.getElementsByName(v).forEach((element)=>{
                            
            if(element.classList.contains("select2") || v == "video" 
            || v == "image" || element.classList.contains("sr-only")){

            }else{

                element.className = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500";
            }
                document.querySelector( this.selector + " div p")?.remove()
            })
        })
    }
    private emptyInputForm()
    {
        this.formData.forEach((k,v)=>{
            if(v != "_token" && v!= "_method"){
                document.getElementsByName(v).forEach((element)=>{
                    element.value = "";
                })
            }
        })
    }
    private insert_success(response:Response)
    {
        const element = document.querySelector(this.selector_table)
        response.json().then(data=>{
            const html =this.createElementFromHTML(data.data);

                
                element?.insertBefore(html, element?.firstChild);

                
            
            
            element?.querySelectorAll("[data-modal-toggle] , [data-drawer-show]").forEach((x_elm)=>{
                let attr_ ,modal;
                if(x_elm.getAttribute("data-modal-toggle") != null){
                    attr_ = "data-modal-toggle";
                    modal = instances.getInstance('Modal',x_elm.getAttribute(attr_)  as string);
                }else{
                    attr_ = "data-drawer-show";
                    modal = instances.getInstance('Drawer',x_elm.getAttribute(attr_)  as string);

                }
                // x_elm.dispatchEvent(new Event("click"));
                
                x_elm.addEventListener("click",()=>{
                    // window.location.reload()

                    console.log(x_elm.getAttribute(attr_))

                        modal.show()
                        if(x_elm.getAttribute(attr_) == "popup-modal")
                        {
                            window.modalPopUp.process(x_elm)
                        }else{

                            window.draweCrudModal.process(x_elm)
                        }
                    // if (modal_1) {
                    //     modal_1.removeAllEventListenerInstances();
                        // x_elm.addEventListener('click', () =>{
                        //     // modal_1.show()
                        // });

                        // modal_1.addEventListenerInstance(x_elm, 'click', toggleModal);
                    // }
                })
                // x_elm.dispatchEvent(new Event("d"));

            })
        })
        // const $targetEl = document.getElementById('crud-modal');

        // const modalObj = new modalEditAction(".modal-crud",this.getFormData());

    }
    private validation(response :Response)
    {
        response.json().then(data=>{
            const obj = data.errors;
            Object.keys(obj).forEach((k )=> {
                this.add_validation(k,obj[k])
            });
        })
    }
    private add_validation(k:string,v:string) 
    {

        document.getElementsByName(k).forEach((element)=>{
            const new_element = document.createElement('p');

            new_element.className = "mt-2 text-sm text-red-600 dark:text-red-500";
            new_element.innerHTML = ` ${v}  <span class="font-medium"> Fail </span>`
            
            if(element.classList.contains("select2")|| k == "video"  
            || k == "image" || element.classList.contains("sr-only")){

            }else{
                element.className ="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500";

            }
            if(element.classList.contains("select2")){
                try {
                    element.parentNode?.insertBefore(new_element, document.querySelector(".select2.select2-container")?.nextSibling);
                    
                } catch (error) {
                    element.parentNode?.insertBefore(new_element, element.nextSibling);

                }

            }else if(element.classList.contains("sr-only"))
            {
                element.parentNode?.parentNode?.insertBefore(new_element, element?.parentNode.nextSibling);

            }else{
                element.parentNode?.insertBefore(new_element, element.nextSibling);

            }

            // insert After
            
        })
        
    }
    private createElementFromHTML(html, trim = true)
    {
        // Process the HTML string.
        html = trim ? html : html.trim();
        if (!html) return null;
        // Then set up a new template element.
        const template = document.createElement('template');
        template.innerHTML = html;
        const result = template.content.children;

        // Then return either an HTMLElement or HTMLCollection,
        // based on whether the input HTML had one or more roots.
        if (result.length === 1) return result[0];
        return result;
    }
    public getFormData():FormData
    {
        return this.formData;
    }
      
};
export default crud;