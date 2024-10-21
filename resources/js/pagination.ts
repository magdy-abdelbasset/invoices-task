class pagination {
    private url:URL;
    private next_p:HTMLElement;
    private prev:HTMLElement;
    private param:string;
    constructor(param="page",next_p="#next_page" , prev="#prev_page")
    {
        this.url = new URL(document.location.href);
        this.param = param;
        this.prev =  this.get_first_by_selector(prev);
        this.next_p =  this.get_first_by_selector(next_p);
        this.lithen();
    }
    private get_first_by_selector(selctor:string):HTMLElement
    {
        return document.querySelector(selctor) as HTMLElement;
    }
    private lithen():void
    {
        this.next_p.addEventListener("click",(e)=>{
            this.add_count(1);
        })
        this.prev.addEventListener("click",(e)=>{
            
            this.add_count(-1);
        })
    }
    private add_count(count:number):void
    {
        const urlParams = this.url.searchParams;
        const new_param = (parseInt((urlParams.get(this.param) ?? 1) as string)+count).toString();
        urlParams.set(this.param,new_param)
        document.location.href = this.url.toString()
    }


};
export default pagination;