function updateQuantity(button, delta) {
    var form = button.closest('.quantity-form');
    var quantityInput = form.querySelector('.quantity');
    var quantityValue = parseInt(quantityInput.value) + delta;
    var index = form.querySelector('input[name="index"]').value;

    if (quantityValue > 0) {
        quantityInput.value = quantityValue;

        $.ajax({
            url: 'index.php?page=handle-update-cart',
            type: 'POST',
            data: {
                index: index,
                quantity: quantityValue
            },
            success: function (response) {
                try {
                    var data = JSON.parse(response);
                    var itemTotalElement = document.querySelector('.line-item-total[data-index="' + index + '"]');
                    var grandTotalElement = document.querySelector('.total-price');
                    if (itemTotalElement) {
                        itemTotalElement.textContent =
                            parseFloat(data.itemTotal)
                                .toFixed(0)
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ',') + 'đ';
                    }
                    if (grandTotalElement) {
                        grandTotalElement.textContent =
                            parseFloat(data.grandTotal)
                                .toFixed(0)
                                .replace(/\B(?=(\d{3})+(?!\d))/g, ',') + 'đ';
                    }
                    const cartQuantityElement = document.querySelector('#cart-quantity');
                    cartQuantityElement.textContent = data.cartQuantity;
                } catch (e) {
                    console.error('Error parsing JSON response: ', e);
                    console.error('Response received: ', response);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}

function decreaseQuantityInCart(button) {
    updateQuantity(button, -1);
}

function increaseQuantityInCart(button) {
    updateQuantity(button, 1);
}

function deleteProduct(id) {
    var kq = confirm('Bạn có chắc chắn muốn xóa không?');
    if (kq) {
        window.location.href = `index.php?page=handle-delete-cart&index=${id}`;
    }
}
