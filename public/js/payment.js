function openTransferInformation() {
    infoDiv = document.querySelector('.transfer-information');
    infoDiv.classList.add('transfer-information--active');
}

function closeTransferInformation() {
    infoDiv = document.querySelector('.transfer-information');
    infoDiv.classList.remove('transfer-information--active');
}

// AJAX để load quận/huyện và phường/xã
document.getElementById('province').addEventListener('change', function () {
    let provinceId = this.value;

    fetch(`index.php?page=get-districts&province_id=${provinceId}`)
        .then(response => response.json())
        .then(data => {
            let districtSelect = document.getElementById('district');
            districtSelect.innerHTML = '<option value="">Quận / huyện</option>';
            data.forEach(district => {
                districtSelect.innerHTML += `<option value="${district.id}">${district.name}</option>`;
            });
            districtSelect.disabled = false;
            document.getElementById('ward').innerHTML = '<option value="">Phường / xã</option>';
            document.getElementById('ward').disabled = true;
        });
});

document.getElementById('district').addEventListener('change', function () {
    let districtId = this.value;

    fetch(`index.php?page=get-wards&district_id=${districtId}`)
        .then(response => response.json())
        .then(data => {
            let wardSelect = document.getElementById('ward');
            wardSelect.innerHTML = '<option value="">Phường / Xã</option>';
            data.forEach(ward => {
                wardSelect.innerHTML += `<option value="${ward.id}">${ward.name}</option>`;
            });
            wardSelect.disabled = false;
        });
});

document.addEventListener('DOMContentLoaded', function () {
    const applyDiscountButton = document.getElementById('apply-discount');
    const discountCodeInput = document.getElementById('discount-code');
    const totalPayment = document.getElementById('total-payment');
    const discountMessage = document.querySelector('.form-message');

    applyDiscountButton.addEventListener('click', function (e) {
        e.preventDefault();

        const discountCode = discountCodeInput.value.trim();
        const grandTotal = parseInt(totalPayment.textContent.replace(/[^\d]/g, ''));

        // Gửi Ajax request
        fetch('index.php?page=apply-discount', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `code=${encodeURIComponent(discountCode)}&total=${grandTotal}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật giao diện
                    discountMessage.style.color = '#28a745';
                    totalPayment.textContent = new Intl.NumberFormat().format(data.newTotal) + 'đ';
                } else {
                    discountMessage.style.color = '#f4516c';
                }
                discountMessage.textContent = data.message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
