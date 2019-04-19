var drupalJsonData = JSON.parse(document.querySelector("[data-drupal-selector=drupal-settings-json]").innerHTML);
console.log(JSON.parse(document.querySelector("[data-drupal-selector=drupal-settings-json]").innerHTML));

L.custom = {

    init: function (obj, params) {

        window.map = L.map(obj, {
            center: [50.5, 5],
            zoom: 5,
            background: "graybg",
            width: 360,
            height: 240
        });

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

        $wt.next(obj);

    }

};
