var drupalJsonData = JSON.parse(document.querySelector("[data-drupal-selector=drupal-settings-json]").innerHTML);
console.log(JSON.parse(document.querySelector("[data-drupal-selector=drupal-settings-json]").innerHTML));

mapconfig = {
    "center": [
        57,
        5
    ],
    "zoom": 4,
    "minZoom": 2,
    "maxZoom": 24,
    "height": 560,
    "background": "graybg"
};

choroconfig = {
    ranges: [
        {
            "color": '#ffffff',
            "stop": 0
        },
        {
            "style": "theme_1_+",
            "stop": 100
        },
        {
            "style": "na",
            "legend": "Not available"
        }

    ],
    "legend": {
        "type": "gradient"
    },
    "styles": {},
    "values": drupalJsonData.pledge.pledge_countries,
};

L.custom = {
    init: function (obj) {
        // MAP ITSELF
        window.map = L.map(obj, mapconfig);

        // Add the chorojson.
        map.chorojson.add(choroconfig);
        $wt.next(obj);

        var STYLE = function (feature, layer) {
            return {
                weight: 1,
                color: "#fff",
                opacity: 1,
                fillColor: "#369",
                fillOpacity: 0.75
            };
        };

        map.countries.add([
                {
                    level: 0,
                    countries: drupalJsonData.pledge.pledge_countries
                }
            ],
            {
                style: STYLE,
                label: {
                    mode: "fixe",
                    type: "latin"
                }
            }
        );
    }
};


