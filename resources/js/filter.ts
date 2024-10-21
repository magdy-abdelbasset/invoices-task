import event_class, { processEvent } from "./event";
class filter_data  extends event_class implements processEvent{
    private url:URL;
    private attr:string;
    constructor(selector,attr="data-input-name")
    {
        super(selector);
        this.attr = attr;
        this.url = new URL(document.location.href);
        this.add_listen("click",this);
    }
    private getName(element:HTMLElement):string
    {
        return element.getAttribute(this.attr) as string;
    }
    private get_first_by_name(name:string):HTMLInputElement
    {
        
        return document.getElementsByName(name)[0] as HTMLInputElement;
    }
    public process(element:HTMLElement)
    {
        const x =element;
        const name = this.getName(x) ;
        const by_nam_element = this.get_first_by_name(name);
        by_nam_element.value = "";
        const urlParams = this.url.searchParams;
        urlParams.delete(name)
        document.location.href = this.url.toString()
    } 


};
export default filter_data;