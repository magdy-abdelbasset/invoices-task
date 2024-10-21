class screenView
{
    static visibilityMonitor(id,obj:object,method:string){
        
        const observer = new IntersectionObserver(function(entries) {
            if(entries[0].isIntersecting === true) {
                // console.log('Item has just APPEARED!');
                obj[method]();
            } else {
                // console.log('Item has just DISAPPEARED!');
            }
        }, { threshold: [0] });
        const element = document.getElementById(id);
        if(element == null){
            return;
        }
        observer.observe(element as Element);
    }    
}
export default screenView;