import { get_url_extension } from "./urls";

export function selectedOption(elm_select:HTMLSelectElement ,value:string):void
{
    elm_select.setAttribute("value",value)
    const arr= Array.from(elm_select.options);
    arr.forEach((l)=>{
        l.removeAttribute("selected");
    })
    const optionToSelect:HTMLOptionElement = arr.find(item => item.value ==value) as HTMLOptionElement;
    optionToSelect.selected = true;
    elm_select.dispatchEvent(new Event("change"));

    

}
export function setTinyValue(name:string,value:string)
{
    if(typeof tinymce != "undefined"){
        if(tinymce.get(name)!= null){
            tinymce.get(name).getBody().innerHTML = value;
        }
        tinymce.triggerSave();
    }
}
export function setCheckBox(value:string,elm_input:HTMLInputElement):void
{
                
    if(value == "1"){
        elm_input.checked = true;
    }else{
        elm_input.checked = false;
    }
}
export function setFile(value,name):void
{
    const ext = get_url_extension(value);
    if(["jpg","jpeg","png"].includes(ext))
    {
        const image_e = document.getElementById(`image-${name}`) as HTMLImageElement;

        if(value==""){
            image_e.parentNode?.classList.add("hidden")
        }else{
        

            if(image_e != null){
                image_e.src = value; 
            }
       }

       image_e.parentNode?.classList.remove("hidden")
    }else if(["mp4"].includes(ext))
    {
        const video_e = document.getElementById(`video-${name}`) as HTMLVideoElement;

        if(value==""){
            video_e.parentNode?.classList.add("hidden")
        }else{
        

            if(video_e != null){
                video_e.src = value; 
            }
       }

       video_e.parentNode?.classList.remove("hidden")
    }
}
export async function  sendApiRequest(url,method:string="GET")
{
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') as string;
    const response = await fetch(url, {
        headers: {
            accept:"application/json",
            "X-CSRF-TOKEN": token,
        },
        method: method,
        });
        
    return response;
}
export async function  sendPostApiRequest(url,body)
{
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') as string;
    const response = await fetch(url, {
        headers: {
            accept:"application/json",
            "X-CSRF-TOKEN": token,
            // 'Content-Type': 'application/json'

        },
        method: "POST",
        body:body
        });
        
    return response;
}
