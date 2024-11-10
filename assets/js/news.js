function showLoading(button) {
    button.classList.add('loading');
    setTimeout(() => {
      button.classList.remove('loading');
    }, 3000);
}
  