import { Modal } from "flowbite";
import modalAction from "./modal";
import crud from "./crud";
class modalEditAction  extends modalAction {
    private formData:FormData;
    private selector_target:string;
    private crud:crud;
    constructor(selector:string,crud:crud,selector_taget="data-modal-target",inputs:Array<string>=[],attr:string="data-action")
    {
        super(selector);
        this.crud =crud;
        this.formData = crud.getFormData();
        this.selector_target = selector_taget;
        inputs.forEach(input=>{
            if(!this.formData.has(input)){
                this.formData.append(input,"0")
            }
        })

        this.add_listen("click",this);
        

    }


    public process(element:HTMLElement)
    {

        const modal_ = document.getElementById(element.getAttribute(this.selector_target) as string );
        console.log("edit")

        this.crud.intialDomForm();
        element = element as HTMLElement;
       const element2 = modal_.querySelector(" form") as HTMLFormElement;
       element2.action = (element.getAttribute(this.getAttr()) || "").toString() ;
        const data =JSON.parse(element.getAttribute(`data-data`) as string);
        let value =""; 
       this.formData.forEach((k,name)=>{
            document.getElementsByName(name).forEach(elm=>{

                switch (name) {
                    case "_token":
                        break;
                    case "_method":
                        modal_.querySelector("  .header").innerHTML = modal_.getAttribute("data-edit")
                        elm.value = "PATCH"
                        break;
                    default:
                        value = data[name];
                        this.setValues(name,value,elm as HTMLElement)
                        // element.getAttribute("data-"+name);
                        break;
                }
            })
       })

// or whatever the event type might be
    } 


};
export default modalEditAction;