import Toast from "awesome-toast-component";
import screenView from "./screen";
import { sendApiRequest, sendPostApiRequest } from "./utils";
import { Dropdown } from "flowbite";
import { addDrawerShowEvent, addDropDownEvent, addModalShowEvent } from "./events";
import modalAction from "./modal";

class paginationApi {
    private url: URL;
    private param: string;
    private per_page: number;
    private id: string = "loade";
    private method: string = "GET";
    private params_inputs: Array<string> = [];
    private remove_class_loader: string = "loader";
    constructor(url: string | null = null, per_page = 15, param: string = "page") {
        if (url == null) {

            this.url = new URL(document.location.href);
        } else {

            this.url = new URL(url);
        }
        this.per_page = per_page;
        this.param = param;

    }
    private nextPage() {
        this.add_count(1);
    }
    public setPage(value) {
        const urlParams = this.url.searchParams;
        urlParams.set(this.param, value)
    }
    // params array from name input
    public load1(id: string = "loading", params: Array<string> = [], starter_page: number = 1, method: string = "GET", remove_class_loader = "loader"): void {
        this.id = id;
        this.remove_class_loader = remove_class_loader;
        this.method = method;
        this.params_inputs = params;
        this.add_count(starter_page);
        screenView.visibilityMonitor(this.id, this, "load1_event");

    }
    private load1_event() {
        this.add_params(this.params_inputs);

        const element = document.getElementById(this.id);
        if (element == null) {
            return;
        }
        const element_input = document.querySelector(`[name=post_id]`) as HTMLInputElement;
        if (element?.getAttribute("is_new") == "1") {
            element.setAttribute("is_new", "0")
            this.setPage(1);

        }
        this.add_param("json", "yes");

        sendApiRequest(this.url, this.method).then(response => {
            if (response?.status == 200) {
                response.json().then(data => {
                    if (data.data.count > 0) {
                        element?.insertAdjacentHTML(typeof element?.getAttribute("data-insert") == undefined ? "beforebegin" : element?.getAttribute("data-insert") as InsertPosition, data.data.html)
                        this.add_count(1)

                        this.load1_add_events();
                    }
                    if (data.data.count < this.per_page) {
                        element?.classList.remove(this.remove_class_loader)
                    }
                })
            }else if(response?.status == 404){
                document.getElementById(this.id)?.classList.remove("loader")
            }
        });
    }
    private add_count(count: number): string {
        const urlParams = this.url.searchParams;
        const new_param = (parseInt((urlParams.get(this.param) ?? 1) as string) + count).toString();
        urlParams.set(this.param, new_param)
        return this.url.toString()
    }
    public add_param(param: string, value: string): void {
        const urlParams = this.url.searchParams;
        urlParams.set(param, value)
    }
    private add_params(array: Array<string>): void {
        const urlParams = this.url.searchParams;
        array.forEach(key => {
            const element = document.querySelector(`[name=${key}]`) as HTMLInputElement;
            let value = element != null ? element.value : '';
            urlParams.set(key, value)
        })
    }
    private load1_add_events() {
        const element_input = document.querySelector(`[name=post_id]`) as HTMLInputElement;
        const container_id = document.getElementById(this.id)?.getAttribute("data-container-id");
        const element = document.getElementById(container_id as string)
        const elements = element?.querySelectorAll(`[data-dropdown-toggle]:nth-last-child(-n+${this.per_page})`);
        elements?.forEach(elm => {
            addDropDownEvent(elm)
        })
        const elements2 = element?.querySelectorAll(`[data-drawer-toggle]:nth-last-child(-n+${this.per_page})`);
        elements2?.forEach(elm => {
            addDrawerShowEvent(elm)
            elm.addEventListener("click", (x) => {
                let id_drawer = elm.getAttribute("data-drawer-toggle");
                element_input.value = elm.getAttribute("data-post_id") as string;

                document.querySelectorAll(`#${id_drawer} > div:not(:last-child)`).forEach(x => {
                    x.remove();
                    let last_child_loading = document.querySelector(`#${id_drawer} > div:last-child`);
                    last_child_loading?.setAttribute("is_new", "1")
                    last_child_loading?.classList.add(this.remove_class_loader);

                })
            })
        })
        const elements3 = element?.querySelectorAll(`[data-modal-toggle]:nth-last-child(-n+${this.per_page})`);
        elements3?.forEach(elm => {
            addModalShowEvent(elm)
            new modalAction(".modal-popup")
        })
        if (this.id == 'loading-chat-users') {
            this.load_add_event_custom()
        }

    }
    public load_add_event_custom() {
        document.querySelectorAll(".user_div").forEach((el) => {
            el.addEventListener("click", () => { this.setUser(el) }, false);
        })
    }
    public getUrl() {
        return this.url;
    }
    private setUser(selector) {
        let userIdInput = document.querySelector(`[name=user_id]`) as HTMLInputElement;
        let user_id = selector.getAttribute("data-user-id");
        window.pageApi.add_param("user_id", user_id)
        window.pageApi.add_param("page", "1")
        document.querySelectorAll(".row-message").forEach(e => { e.remove() })
        userIdInput.value = user_id
        const element = document.getElementById("loading-chat-messages");
        sendApiRequest(window.pageApi.getUrl()).then((res) => {
            res.json().then(d => {
                element?.insertAdjacentHTML(typeof element?.getAttribute("data-insert") == undefined ? "beforebegin" : element?.getAttribute("data-insert") as InsertPosition, d.data.html)
                let objDiv = document.getElementById("messages-container") as HTMLElement
                objDiv.scrollTop = objDiv.scrollHeight;

            })

        })

    }

};
export default paginationApi;