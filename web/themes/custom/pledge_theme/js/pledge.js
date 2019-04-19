(function ($, Drupal) {
    Drupal.behaviors.pledgePage = {
        attach: function (context, settings) {
            var g;

            function set_gauge(value, label, color_code) {
                $("#gauge2").html("");
                // var color = ["#f5fcff", "#c2eaff", "#6dceff", "#29b7ff", "#0081c2", "#003d5c"];

                g = new JustGage({
                    id: "gauge2",
                    value: value,
                    min: 0,
                    max: 100,
                    title: " ",
                    gaugeColor: color_code,
                    // levelColors: color,
                    label: label
                });
            }

            $('.nav-tabs a', context).on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                if ((target == '#progress')) {
                    if (settings.pledge.pledge_percent != null) {
                        var percent = settings.pledge.pledge_percent;
                        var status = settings.pledge.pledge_status;
                        var color = settings.pledge.pledge_color;
                        console.log(percent);
                        set_gauge(percent, status, color);
                    }
                }
            });

        }
    };


})(jQuery, Drupal);