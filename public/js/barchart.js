$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/api/dashboard/bar-chart", // Ensure this URL matches your Laravel route
        dataType: "json",
        success: function (data) {
            console.log("AJAX request successful");
            console.log(data); // Log the data to check its structure

            if (!data.labels || !data.data) {
                console.error("Data format is incorrect. Expected 'labels' and 'data' properties.");
                return;
            }

            var ctx = $("#barChart"); // Ensure this ID matches your canvas element
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Sales per Category',
                        data: data.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Use a static color for simplicity
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        error: function (error) {
            console.error("AJAX request failed");
            console.log(error); // Log any errors
        }
    });
});