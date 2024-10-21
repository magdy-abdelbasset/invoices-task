import event_class from "./event";
import { sendApiRequest } from "./utils";

class Chat  extends event_class implements processEvent{
    private url:URL;
    private selected;
    constructor(selector)
    {
        super(selector);
        this.selected = document.querySelector(selector)
        this.url = new URL(this.selected.data.url);
        this.add_listen("change",this);
    }
    public process(element:HTMLElement)
    {
        sendApiRequest(this.url,"POST",
        {"search":this.selected.value}
        ).then(response=>{
            console.log(response)
        });
    } 
}