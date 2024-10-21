import instances from "flowbite/lib/esm/dom/instances";
import event_class, { processEvent } from "./event";
import { selectedOption, sendApiRequest, setCheckBox, setFile, setTinyValue } from "./utils";
// import Toast from "awesome-toast-component";
class modalAction  extends event_class implements processEvent{
    private attr:string;
    private attr_target:string;
    constructor(selector,attr_target="data-modal-target",attr="data-action" )
    {
        super(selector);
        this.attr = attr;
        this.attr_target = attr_target;
        this.add_listen("click",this);
    }
    public process(element:HTMLElement)
    {
        const container_id = element.getAttribute("data-container_id");
        const modal_ = document.getElementById(element.getAttribute(this.attr_target) as string );
        const element2 = modal_.querySelector(" form") as HTMLFormElement;
        element2.action = (element.getAttribute(this.attr) || "").toString() ;
        //    try {
        if(modal_.id != "popup-modal"){

            modal_.querySelector( ".header").innerHTML = modal_.getAttribute("data-new") as string;
         
            modal_.querySelector(" form input[name=_method]").value = "POST";
            if(element.getAttribute("data-method") != null)
            {
                    modal_.querySelector("  .header").innerHTML = modal_.getAttribute("data-edit")
                    modal_.querySelector(" form input[name=_method]").value = element.getAttribute("data-method");
     
     
            }
        }else{
            if(element.getAttribute("data-method") != null)
            {
                if(element.getAttribute("data-api") == "delete")
                {
                    this.deleteApi(container_id,element.getAttribute(this.attr),"DELETE",modal_?.querySelector("form"),element.getAttribute(this.attr_target));
                }
                    modal_.querySelector(" form input[name=_method]").value = element.getAttribute("data-method");
            }else{

                modal_.querySelector(" form input[name=_method]").value = "POST";
            }
   
        }
    //    } catch (error) {
        
    //    }
       this.emptyInputForm(element);

    } 
    protected deleteApi(container_id,url:string ,method:string ,element,attr)
    {
        element.addEventListener("submit",(e)=>{
            e.preventDefault();
            sendApiRequest(url,method).then(response=>{
                if(response.status == 200)
                {
                    response.json().then(data=>{
                        const modal = instances.getInstance('Modal',attr  as string);
                       document.getElementById(container_id+data.data.id)?.remove();
                       modal.hide()
                    //    new Toast("تم بنجاح 😍",{
                    //     position:'top'
                    // })
                    })
                }
            })
        })   
    }
    protected getAttr():string
    {
        return this.attr;
    }
    protected emptyInputForm(element:HTMLElement)
    {

        const formData = new FormData(document.querySelector("#"+(element.getAttribute(this.attr_target) as string + " form" )) as HTMLFormElement);

        formData.forEach((k,v)=>{
            if(v != "_token" && v!= "_method"){
                document.getElementsByName(v).forEach((element)=>{
                    this.setValues(v,"",element)
                });
            }

        })
    }
    protected setValues(name:string ,data:string ,elm:HTMLElement)
    {
        switch (elm.tagName) {
            case "INPUT":
                const elm_input = elm as HTMLInputElement;
                switch (elm_input.getAttribute("type")) {
                    case "file":
                        setFile(data,name);
                        break;
                    case "checkbox":
                        setCheckBox(data,elm_input);
                        break;
                    default:
                        elm_input.value = data;
                        break;
                }
                break;
            case "SELECT" :
                const elm_select = elm as HTMLSelectElement;
                selectedOption(elm_select,data)
                break;
            case "checkbox":
                break
            case "TEXTAREA":
                elm.innerHTML = data;
                setTinyValue(name,data)
                break;
            default:
                break;
        }
    }
};
export default modalAction;