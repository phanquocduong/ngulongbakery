import CodeBlock from "@ckeditor/ckeditor5-code-block/src/codeblock";
(function ($) {
  ("use strict");
  // Thêm bài viết
  document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor.create(document.querySelector("#content"), {
      language: "vi",
      ckfinder: {
        uploadUrl:
          "/ngulongbakery/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json",
      },
      toolbar: {
        items: [
          "fontfamily",
          "fontsize",
          "|",
          "heading",
          "|",
          "alignment",
          "|",
          "fontColor",
          "fontBackgroundColor",
          "|",
          "bold",
          "italic",
          "underline",
          "subscript",
          "superscript",
          "|",
          "link",
          "|",
          "outdent",
          "indent",
          "|",
          "bulletedList",
          "numberedList",
          "todoList",
          "|",
          "code",
          "codeBlock",
          "|",
          "insertTable",
          "|",
          "uploadImage",
          "|",
          "ckfinder",
          "undo",
          "redo",
        ],
        shouldNotGroupWhenFull: true,
      },
    })
      .then((editor) => {
        console.log("CKEditor initialized successfully!", editor);
      })
      .catch((error) => {
        console.error("Error initializing CKEditor:", error);
      });
  });

  // định nghĩa popup ckfinder
  document.addEventListener("DOMContentLoaded", function () {
    function openPopup(idobj) {
      CKFinder.popup({
        chooseFiles: true,
        onInit: function (finder) {
          finder.on("files:choose", function (evt) {
            var file = evt.data.files.first();
            document.getElementById(idobj).value = file.getUrl();
          });
          finder.on("file:choose:resizedImage", function (evt) {
            document.getElementById(idobj).value = evt.data.resizedUrl;
          });
        },
      });
    }
  });

  // format thời gian đăng bài viết
  document.addEventListener("DOMContentLoaded", function () {
    // Định dạng thời gian đăng bài viết
    var options = { timeZone: "Asia/Ho_Chi_Minh" };
    var d = new Date();
    var formattedDate = d.toLocaleString("vi-VN", options);

    // Hiển thị ngày giờ đã định dạng
    // document.querySelector(".date-create").innerHTML =
    //   "Thời gian tạo bài viết: " + formattedDate;

    // Đặt giá trị cho trường create_date
    document.getElementById("create_date").value = "Thời gian" + formattedDate;
  });

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
  /*   document.addEventListener("DOMContentLoaded", function () {
    const orderStatusSelect = document.getElementById("order-status");
    const exportButton = document.getElementById("export-button");
    const inExportButton = document.getElementById("in-export-button");

    orderStatusSelect.addEventListener("change", function () {
      if (orderStatusSelect.value === "Đã Xác Nhận") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.border = "none";
        console.log(orderStatusSelect.value);
        inExportButton.innerHTML = `Xác nhận `;
      }
      else if (orderStatusSelect.value === "Đang Giao") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.border = "none";
        inExportButton.innerHTML = `Xác nhận giao hàng`;
      }
      else if (orderStatusSelect.value === "Đã Giao") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.backgroundColor = "#2194E6";
        inExportButton.style.border = "none";
        inExportButton.innerHTML = `Xác nhận đã giao hàng`;
      }
      else if (orderStatusSelect.value === "Đã Huỷ") {
        exportButton.disabled = false;
        exportButton.style.backgroundColor = "red";
        inExportButton.style.backgroundColor = "red";
        inExportButton.style.border = "none";
        inExportButton.innerHTML = `Xác nhận hủy`;
      }
      else {
        exportButton.disabled = true;
        exportButton.style.backgroundColor = "#ccc";
        inExportButton.style.backgroundColor = "#ccc";
        inExportButton.style.border = "none";
      }
    });
  }); */

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
})(jQuery);
