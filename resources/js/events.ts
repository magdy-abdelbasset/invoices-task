import { Dropdown } from "flowbite";
import instances from "flowbite/lib/esm/dom/instances";

export function addDropDownEvent(elm)
{
    let dropdownId = elm.getAttribute('data-dropdown-toggle');
    let dropdownEl = document.getElementById(dropdownId as string);
    if (dropdownEl) {
        new Dropdown(dropdownEl, elm, getDefaultDropDown());
    }
    else {
        console.error("The dropdown element with id \"".concat(dropdownId, "\" does not exist. Please check the data-dropdown-toggle attribute."));
    }
}
export function getDefaultDropDown():object
{
    return {
        placement: 'bottom',
        triggerType: 'click',
        offsetSkidding: 0,
        offsetDistance: 10,
        delay: 300,
        ignoreClickOutsideClass: false,
        onShow: function () { },
        onHide: function () { },
        onToggle: function () { },
    };
}
export function addDrawerShowEvent(elm)
{
   const modal =instances.getInstance('Drawer',elm.getAttribute("data-drawer-toggle")  as string);
      elm.addEventListener("click",()=>{
       modal.show();
   })
}
export function addModalShowEvent(elm)
{
   const modal =instances.getInstance('Modal',elm.getAttribute("data-modal-toggle")  as string);
   elm.addEventListener("click",()=>{

       modal.show();
   })
}