document.addEventListener("DOMContentLoaded", function () {
const indexListContainer = document.querySelector(".contentnews-listindex");
const headings = document.querySelectorAll(".contentnews-titlecontent");

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

indexListContainer.appendChild(indexList);
});
