export const options ={
    "annotations": {},
    "chart": {
        "animations": {
            "enabled": false,
            "easing": "swing"
        },
        "background": "#8C8C8C",
        "dropShadow": {
            "blur": 6
        },
        "foreColor": "#fff",
        "fontFamily": "Roboto",
        "height": 250,
        "id": "b6d7E",
        "stackOnlyBar": true,
        "toolbar": {
            "show": false,
            "tools": {
                "selection": true,
                "zoom": true,
                "zoomin": true,
                "zoomout": true,
                "pan": true,
                "reset": true
            }
        },
        "width": 480
    },
    "plotOptions": {
        "bar": {
            "borderRadius": 10,
            "borderRadiusApplication": "end",
            "borderRadiusWhenStacked": "last",
            "hideZeroBarsWhenGrouped": false,
            "isDumbbell": false,
            "isFunnel": false,
            "isFunnel3d": true,
            "dataLabels": {
                "total": {
                    "enabled": false,
                    "offsetX": 0,
                    "offsetY": 0,
                    "style": {
                        "color": "#373d3f",
                        "fontSize": "12px",
                        "fontWeight": 600
                    }
                }
            }
        },
        "bubble": {
            "zScaling": true
        },
        "treemap": {
            "borderRadius": 4,
            "dataLabels": {
                "format": "scale"
            }
        },
        "radialBar": {
            "hollow": {
                "background": "#fff"
            },
            "dataLabels": {
                "name": {},
                "value": {},
                "total": {}
            },
            "barLabels": {
                "enabled": false,
                "margin": 5,
                "useSeriesColors": true,
                "fontWeight": 600,
                "fontSize": "16px"
            }
        },
        "pie": {
            "donut": {
                "labels": {
                    "name": {},
                    "value": {},
                    "total": {}
                }
            }
        }
    },
    "colors": [
        "#3f51b5",
        "#03a9f4",
        "#4caf50",
        "#f9ce1d",
        "#FF9800"
    ],
    "dataLabels": {
        "style": {
            "fontWeight": 700
        }
    },
    "fill": {},
    "grid": {
        "show": false,
        "borderColor": "#6e7eaa",
        "padding": {
            "right": 25,
            "left": 15
        }
    },
    "legend": {
        "fontSize": 14,
        "offsetY": 0,
        "itemMargin": {
            "vertical": 0
        }
    },
    "markers": {
        "hover": {
            "sizeOffset": 6
        }
    },
    "series": [
        {
            "name": "Line",
            "data": [
                {
                    "x": "Item 1",
                    "y": 31
                },
                {
                    "x": "Item 2",
                    "y": 40
                },
                {
                    "x": "Item 3",
                    "y": 28
                },
                {
                    "x": "Item 4",
                    "y": 51
                },
                {
                    "x": "Item 5",
                    "y": 42
                }
            ]
        }
    ],
    "stroke": {
        "colors": [
            "#FCFCFC",
            "#FFFFFF"
        ],
        "fill": {
            "type": "solid",
            "opacity": 0.85,
            "gradient": {
                "shade": "dark",
                "type": "horizontal",
                "shadeIntensity": 0.5,
                "inverseColors": true,
                "opacityFrom": 1,
                "opacityTo": 1,
                "stops": [
                    0,
                    50,
                    100
                ],
                "colorStops": []
            }
        }
    },
    "tooltip": {
        "hideEmptySeries": false
    },
    "xaxis": {
        "offsetY": 8,
        "labels": {
            "trim": true,
            "style": {}
        },
        "group": {
            "groups": [],
            "style": {
                "colors": [],
                "fontSize": "12px",
                "fontWeight": 400,
                "cssClass": ""
            }
        },
        "tickAmount": "dataPoints",
        "title": {
            "style": {
                "fontWeight": 700
            }
        }
    },
    "yaxis": {
        "tickAmount": 5,
        "labels": {
            "style": {}
        },
        "axisBorder": {
            "show": true
        },
        "title": {
            "style": {
                "fontWeight": 700
            }
        }
    },
    "theme": {
        "mode": "dark",
        "palette": "palette2"
    }
}