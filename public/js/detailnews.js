document.addEventListener("DOMContentLoaded", function () {
    const indexListContainer = document.querySelector(".contentnews-listindex");
    const headings = document.querySelectorAll("h3");
    const toggleButton = document.getElementById("toggle-button");

    const indexList = document.createElement("div");
    indexList.classList.add("index-list");

    headings.forEach((heading, index) => {
        if (!heading.id) {
            heading.id = `heading-${index + 1}`;
        }

        const listItem = document.createElement("div");
        const link = document.createElement("a");
        link.href = `#${heading.id}`;
        link.innerText = heading.innerText;
        listItem.appendChild(link);
        indexList.appendChild(listItem);

        link.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(`#${heading.id}`).scrollIntoView({ behavior: "smooth" });
        });
    });

    toggleButton.addEventListener("click", function() {
        if (indexList.style.display === "none") {
            indexList.style.display = "block";
            toggleButton.innerHTML = '<i class="fa-solid fa-bars"></i>';
        } else {
            indexList.style.display = "none";
            toggleButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        }
    });

    indexListContainer.appendChild(indexList);
});