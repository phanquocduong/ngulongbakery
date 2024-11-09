(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // buttuon "Xuất hoá đơn"
  document.addEventListener("DOMContentLoaded", function () {
    const orderStatusSelect = document.getElementById("order-status");
    const exportButton = document.getElementById("export-button");
    const inExportButton = document.getElementById("in-export-button");

    orderStatusSelect.addEventListener("change", function () {
      if (orderStatusSelect.value === "1") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.border = "none";
      } else {
        exportButton.disabled = true;
        exportButton.style.backgroundColor = "#ccc";
        inExportButton.style.backgroundColor = "#ccc";
        inExportButton.style.border = "none";
      }
    });
  });

  // Sidebar Toggler
  $(".sidebar-toggler").click(function () {
    $(".sidebar, .content").toggleClass("open");
    return false;
  });

  // Progress Bar
  $(".pg-bar").waypoint(
    function () {
      $(".progress .progress-bar").each(function () {
        $(this).css("width", $(this).attr("aria-valuenow") + "%");
      });
    },
    { offset: "80%" }
  );

  // Calender
  $("#calender").datetimepicker({
    inline: true,
    format: "L",
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    items: 1,
    dots: true,
    loop: true,
    nav: false,
  });

  // star
  document.addEventListener("DOMContentLoaded", function () {
    const toggleStarButtons = document.getElementsByClassName("toggle-star");
    Array.prototype.forEach.call(toggleStarButtons, function (button) {
      button.addEventListener("click", function () {
        const starIcon = this.getElementsByClassName("fa-star")[0];
        if (starIcon) {
          starIcon.classList.toggle("star-active");
        }
      });
    });
  });

  // up new image in edit account
  document.addEventListener("DOMContentLoaded", function () {
    const profileImage = document.getElementById("profile-image");
    const imageUpload = document.getElementById("image-upload");

    if (profileImage && imageUpload) {
      profileImage.addEventListener("click", function () {
        imageUpload.click();
      });

      imageUpload.addEventListener("input", function () {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            profileImage.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    }
  });



  // trạng thái tài khoản
  document.addEventListener("DOMContentLoaded", function () {
    const statusCells = document.querySelectorAll(".status-text");

    statusCells.forEach(function (cell) {
      const statusText = cell.textContent.trim();
      const statusIcon = cell.previousElementSibling;

      if (statusText === "Đã tắt" && statusIcon) {
        statusIcon.className = "status-icon status-offline";
      } else if (statusText === "Đang hoạt động" && statusIcon) {
        statusIcon.className = "status-icon status-online";
      }
    });
  });

  // Biểu đồ thống kê
  // var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
  // var myChart1 = new Chart(ctx1, {
  //     type: "bar",
  //     data: {
  //         labels: ["01", "02", "03", "04", "05", "06"],
  //         datasets: [{
  //                 label: "Bánh bông lan",
  //                 data: [15, 30, 55, 65, 60, 80, 95],
  //                 backgroundColor: "rgba(0, 156, 255, .7)"

  //             },
  //             {
  //                 label: "UK",
  //                 data: [8, 35, 40, 60, 70, 55, 75],
  //                 backgroundColor: "rgba(0, 156, 255, .5)"
  //             },
  //             {
  //                 label: "AU",
  //                 data: [12, 25, 45, 55, 65, 70, 60],
  //                 backgroundColor: "rgba(0, 156, 255, .3)"
  //             }
  //         ]
  //         },
  //     options: {
  //         responsive: true
  //     }
  // });

  // Salse & Revenue Chart
  var ctx2 = $("#salse-revenue").get(0).getContext("2d");
  var myChart2 = new Chart(ctx2, {
    type: "line",
    data: {
      labels: ["2016", "2017", "2018", "2019", "2020", "2021", "2022"],
      datasets: [
        {
          label: "Salse",
          data: [15, 30, 55, 45, 70, 65, 85],
          backgroundColor: "rgba(0, 156, 255, .5)",
          fill: true,
        },
        {
          label: "Revenue",
          data: [99, 135, 170, 130, 190, 180, 270],
          backgroundColor: "rgba(0, 156, 255, .3)",
          fill: true,
        },
      ],
    },
    options: {
      responsive: true,
    },
  });

  // Single Line Chart
  var ctx3 = $("#line-chart").get(0).getContext("2d");
  var myChart3 = new Chart(ctx3, {
    type: "line",
    data: {
      labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
      datasets: [
        {
          label: "Salse",
          fill: false,
          backgroundColor: "rgba(0, 156, 255, .3)",
          data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15],
        },
      ],
    },
    options: {
      responsive: true,
    },
  });

  // Single Bar Chart
  var ctx4 = $("#bar-chart").get(0).getContext("2d");
  var myChart4 = new Chart(ctx4, {
    type: "bar",
    data: {
      labels: ["Italy", "France", "Spain", "USA", "Argentina"],
      datasets: [
        {
          backgroundColor: [
            "rgba(0, 156, 255, .7)",
            "rgba(0, 156, 255, .6)",
            "rgba(0, 156, 255, .5)",
            "rgba(0, 156, 255, .4)",
            "rgba(0, 156, 255, .3)",
          ],
          data: [55, 49, 44, 24, 15],
        },
      ],
    },
    options: {
      responsive: true,
    },
  });

  // Pie Chart
  var ctx5 = $("#pie-chart").get(0).getContext("2d");
  var myChart5 = new Chart(ctx5, {
    type: "pie",
    data: {
      labels: ["Italy", "France", "Spain", "USA", "Argentina"],
      datasets: [
        {
          backgroundColor: [
            "rgba(0, 156, 255, .7)",
            "rgba(0, 156, 255, .6)",
            "rgba(0, 156, 255, .5)",
            "rgba(0, 156, 255, .4)",
            "rgba(0, 156, 255, .3)",
          ],
          data: [55, 49, 44, 24, 15],
        },
      ],
    },
    options: {
      responsive: true,
    },
  });

  // Doughnut Chart
  var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
  var myChart6 = new Chart(ctx6, {
    type: "doughnut",
    data: {
      labels: ["Italy", "France", "Spain", "USA", "Argentina"],
      datasets: [
        {
          backgroundColor: [
            "rgba(0, 156, 255, .7)",
            "rgba(0, 156, 255, .6)",
            "rgba(0, 156, 255, .5)",
            "rgba(0, 156, 255, .4)",
            "rgba(0, 156, 255, .3)",
          ],
          data: [55, 49, 44, 24, 15],
        },
      ],
    },
    options: {
      responsive: true,
    },
  });
})(jQuery);
