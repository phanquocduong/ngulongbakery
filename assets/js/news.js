let initialVisibleNews = 6;
const news = document.querySelectorAll('.news-item');
function showInitialNews() {
  news.forEach((news, index) => {
      news.style.display = index < initialVisibleNews ? 'block' : 'none';
  });
}
showInitialNews();
function showLoading(button) {
  button.classList.add('loading');
  setTimeout(() => {
  const hiddenNews = [...news].filter(
    news => news.style.display === 'none'
);
hiddenNews.slice(0, initialVisibleNews).forEach(news => {
    news.style.display = 'block';
});
if (hiddenNews.length <= initialVisibleNews) {
  button.style.display = 'none';
}

button.classList.remove('loading');
},1500)
}
  