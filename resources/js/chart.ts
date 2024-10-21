import { options as options1 } from "./chart1";
import { options as options2 } from './chart2';
import { options as options3 } from './chart-circle';
import { sendApiRequest } from "./utils";
// import * as ApexCharts from "apexcharts";
class Chart {
    options = {};
    data;
    chart;
    style;
    id;
    svg = ` <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>`;
    constructor(id, style = 1) {

        this.style =style 
        this.id = id;
        switch (style) {
            case 1:
                this.options = JSON.parse(JSON.stringify(options1));
                break;
            case 2:
                this.options = JSON.parse(JSON.stringify(options2));
                break;
            case 3:
                this.options = JSON.parse(JSON.stringify(options3));
                this.data = JSON.parse(document.getElementById(id)?.getAttribute("data-data") ?? "[]")
                let series = [];
                let colors = [];
                let labels = [];
                for (let result of Array.from(this.data)) {
                    series.push(result.count);
                    colors.push(result.color);
                    labels.push(result.title);
                }
                this.options.series = series;
                this.options.colors = colors;
                this.options.labels = labels;
                break;
            default:
                break;
        }
        if (document.getElementById(id) && typeof ApexCharts !== 'undefined') {
            this.chart = new ApexCharts(document.getElementById(id), this.options);
            this.chart.render();
        }
    }
    update(el) {
        switch (this.style) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                sendApiRequest(el.getAttribute("data-url") +`?days=${el.getAttribute("data-days")}`).then(res=>{
                    res.json().then(d=>{
                        this.data = d.data
                        let series = [];
                        let colors = [];
                        let labels = [];
                        for (let result of Array.from(this.data)) {
                            series.push(result.count);
                            colors.push(result.color);
                            labels.push(result.title);
                        }
                        this.options.series = series;
                        this.options.colors = colors;
                        this.options.labels = labels;
                        let options = JSON.parse(JSON.stringify(this.options));
                        this.chart.updateOptions(options)
                    });

                })

                break;
            default:
                break;
        }
        document.getElementById(`${this.id}-dropdownButton`).innerHTML = `${el.innerText} ${this.svg}`


        // this.chart.updateOptions(this.options)
    }

}
export default Chart;