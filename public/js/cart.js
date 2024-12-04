// Cập nhật số lượng sản phẩm
function updateQuantity(button, delta, stock) {
    const form = button.closest('.quantity-form');
    const quantityInput = form.querySelector('.quantity');
    const quantityValue = parseInt(quantityInput.value) + delta;
    const index = form.querySelector('input[name="index"]').value;

    if (quantityValue > stock) {
        Swal.fire({
            title: 'Số lượng sản phẩm vượt quá số lượng hàng tồn kho',
            icon: 'error',
            showConfirmButton: true
        });
    }

    if (quantityValue > 0 && quantityValue <= stock) {
        quantityInput.value = quantityValue;

        fetch(`${baseUrl}/index.php?page=handle-update-cart`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                index: index,
                quantity: quantityValue
            })
        })
            .then(response => response.json())
            .then(data => {
                const itemTotalElement = document.querySelector(`.line-item-total[data-index="${index}"]`);
                const grandTotalElement = document.querySelector('.total-price');
                if (itemTotalElement) {
                    itemTotalElement.textContent =
                        parseFloat(data.itemTotal)
                            .toFixed(0)
                            .replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'đ';
                }
                if (grandTotalElement) {
                    grandTotalElement.textContent =
                        parseFloat(data.grandTotal)
                            .toFixed(0)
                            .replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'đ';
                }
                document.querySelector('#cart-quantity').textContent = data.cartQuantity;
            })
            .catch(error => {
                console.error('Error updating cart:', error);
            });
    }
}

// Giảm số lượng sản phẩm
function decreaseQuantityInCart(button, stock) {
    updateQuantity(button, -1, stock);
}

// Tăng số lượng sản phẩm
function increaseQuantityInCart(button, stock) {
    updateQuantity(button, 1, stock);
}

// Xóa sản phẩm khỏi giỏ hàng
function deleteProduct(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa không?',
        text: 'Hành động này không thể hoàn tác.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Có, xóa nó!',
        cancelButtonText: 'Hủy'
    }).then(result => {
        if (result.isConfirmed) {
            window.location.href = `${baseUrl}/index.php?page=handle-delete-cart&index=${id}`;
        }
    });
}
