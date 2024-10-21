class event_class {
    protected selector;
    constructor (selctor){
        this.selector =selctor;
    }
    protected add_listen(event="click",obj)
    {
        document.querySelectorAll(this.selector).forEach((element)=>{
            element.addEventListener(event,()=>{obj.process(element)})
        });
    }


};
interface processEvent{
    process(elemnt:HTMLElement):void;
}
export default event_class;
export {processEvent}