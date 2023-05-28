$(document).ready(function () {
    let interval = setInterval(function () {
        $(".icon-check").animate({ marginTop: "-=20px" }, 500);
        $(".icon-check").animate({ marginTop: "+=20px" }, 500);
        if (
            $(".icon-check")
                .parent(".card-body")
                .find(".d-inline-block")
                .find("input")
                .val() == 0
        )
            clearInterval(interval);
    }, 100);

    let giaTri = 0;
    let intervalId = setInterval(function () {
        giaTri += $("#revenue").val() / 50;
        $(".revenue").text(numeral(giaTri).format("0,0") + " VNĐ");
        if (giaTri >= $("#revenue").val()) {
            clearInterval(intervalId);
            $(".revenue").text(
                numeral($("#revenue").val()).format("0,0") + " VNĐ"
            );
        }
    }, 70);

    if (
        window.location.href.indexOf("search=") > -1 &&
        window.location.href.indexOf("/admin/report?") > -1
    ) {
        switch (localStorage.getItem("tagActive")) {
            case "customer":
                $(
                    ".a-" +
                        localStorage.getItem("tagActive") +
                        ", #" +
                        localStorage.getItem("tagActive")
                ).addClass("active");
                $(".a-order, .a-revenues, #order, #revenues").each(function () {
                    $(this).removeClass("active");
                });
                break;
            case "order":
                $(
                    ".a-" +
                        localStorage.getItem("tagActive") +
                        ", #" +
                        localStorage.getItem("tagActive")
                ).addClass("active");
                $(".a-customer, .a-revenues, #customer, #revenues").each(
                    function () {
                        $(this).removeClass("active");
                    }
                );
                break;
            case "revenues":
                $(
                    ".a-" +
                        localStorage.getItem("tagActive") +
                        ", #" +
                        localStorage.getItem("tagActive")
                ).addClass("active");
                $(".a-customer, .a-order, #customer, #order").each(function () {
                    $(this).removeClass("active");
                });
                break;
        }
    }
    $("#btn-search-report").on("click", function () {
        var tagActive = $(this)
            .parents()
            .eq(4)
            .find(".nav-item a.active")
            .data("id");
        localStorage.setItem("tagActive", tagActive);
    });
});

$(document).ready(function () {
    "use strict";
    if ($("#cash-deposits-chart").length) {
        var cashDepositsCanvas = $("#cash-deposits-chart")
            .get(0)
            .getContext("2d");
        var urlParams = new URLSearchParams(window.location.search);
        if (
            urlParams.has("time_select") &&
            urlParams.get("time_select") !== ""
        ) {
            localStorage.setItem(
                "chartSearchTime",
                urlParams.get("time_select")
            );
        }
        var data_sets = [];
        var color = "#725454";
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "GET",
            url:
                "api/admin/report/data-chart/" +
                localStorage.getItem("chartSearchTime"),
            success: function (response) {
                $.each(response.data, function (index, value) {
                    switch (value.name_brand) {
                        case "Bentley":
                            color = "#ff4747";
                            break;
                        case "Citizen":
                            color = "#4d83ff";
                            break;
                        case "Baby-G":
                            color = "#ffc100";
                            break;
                        case "Aviator":
                            color = "#04fb00";
                            break;

                        case "G-Shock":
                            color = "#da00ff";
                            break;
                        case "Olym Pianus":
                            color = "#00acff";
                            break;
                    }
                    data_sets.push({
                        label: value.name_brand,
                        data: [
                            parseInt(value.thang_1),
                            parseInt(value.thang_2),
                            parseInt(value.thang_3),
                            parseInt(value.thang_4),
                            parseInt(value.thang_5),
                            parseInt(value.thang_6),
                            parseInt(value.thang_7),
                            parseInt(value.thang_8),
                            parseInt(value.thang_9),
                            parseInt(value.thang_10),
                            parseInt(value.thang_11),
                            parseInt(value.thang_12),
                        ],
                        borderColor: [color],
                        borderWidth: 3,
                        fill: false,
                        pointBackgroundColor: "#fff",
                    });
                });
            },
        });
        var data = {
            labels: [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12",
            ],
            datasets: data_sets,
        };
        var options = {
            scales: {
                yAxes: [
                    {
                        display: true,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: 1,
                            color: "#e9e9e9",
                            zeroLineColor: "#e9e9e9",
                        },
                        ticks: {
                            min: 0,
                            max: 100,
                            stepSize: 20,
                            fontColor: "#6c7383",
                            fontSize: 16,
                            fontStyle: 300,
                            padding: 15,
                        },
                    },
                ],
                xAxes: [
                    {
                        display: true,
                        gridLines: {
                            drawBorder: false,
                            lineWidth: 1,
                            color: "#e9e9e9",
                        },
                        ticks: {
                            fontColor: "#6c7383",
                            fontSize: 16,
                            fontStyle: 300,
                            padding: 15,
                        },
                    },
                ],
            },
            legend: {
                display: false,
            },
            legendCallback: function (chart) {
                var text = [];
                text.push('<ul class="dashboard-chart-legend">');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    text.push(
                        '<li><span style="background-color: ' +
                            chart.data.datasets[i].borderColor[0] +
                            ' "></span>'
                    );
                    if (chart.data.datasets[i].label) {
                        text.push(chart.data.datasets[i].label);
                    }
                }
                text.push("</ul>");
                return text.join("");
            },
            elements: {
                point: {
                    radius: 3,
                },
                line: {
                    tension: 0,
                },
            },
            stepsize: 1,
            layout: {
                padding: {
                    top: 0,
                    bottom: -10,
                    left: -10,
                    right: 0,
                },
            },
        };
        var cashDeposits = new Chart(cashDepositsCanvas, {
            type: "line",
            data: data,
            options: options,
        });
        document.getElementById("cash-deposits-chart-legend").innerHTML =
            cashDeposits.generateLegend();
    }
});
