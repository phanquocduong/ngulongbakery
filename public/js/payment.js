function openTransferInformation() {
    infoDiv = document.querySelector('.transfer-information');
    infoDiv.classList.add('transfer-information--active');
}

function closeTransferInformation() {
    infoDiv = document.querySelector('.transfer-information');
    infoDiv.classList.remove('transfer-information--active');
}

// Load quận/huyện
document.getElementById('province').addEventListener('change', function () {
    let provinceId = this.value;
    let transportFee = 0;

    if (provinceId >= 1 && provinceId <= 30) {
        transportFee = 40000;
    } else if (provinceId >= 31 && provinceId <= 43) {
        transportFee = 30000;
    } else if (provinceId >= 44 && provinceId <= 63) {
        transportFee = 20000;
    }

    // Cập nhật phí vận chuyển trên giao diện
    document.querySelector('.transport-fee__price').textContent = new Intl.NumberFormat().format(transportFee) + 'đ';
    document.querySelector('.transport-fee__price--hidden').value = transportFee;

    const provisionalPrice = parseInt(document.querySelector('.provisional-price').textContent.replace(/[^\d]/g, ''));
    const newTotal = provisionalPrice + transportFee;

    document.getElementById('total-payment').textContent = new Intl.NumberFormat().format(newTotal) + 'đ';
    document.getElementById('total-payment-hidden').value = newTotal;

    fetch(`${baseUrl}/index.php?page=get-districts&province_id=${provinceId}`)
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

// Load phường/xã
document.getElementById('district').addEventListener('change', function () {
    let districtId = this.value;

    fetch(`${baseUrl}/index.php?page=get-wards&district_id=${districtId}`)
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
    const discountMessage = document.querySelector('.form-message');

    applyDiscountButton.addEventListener('click', function (e) {
        e.preventDefault();

        const discountCode = document.getElementById('discount-code').value.trim();
        const provisionalPrice = parseInt(document.querySelector('.provisional-price').textContent.replace(/[^\d]/g, ''));

        fetch(`${baseUrl}/index.php?page=apply-discount`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `code=${encodeURIComponent(discountCode)}&provisional=${provisionalPrice}`
        });

        fetch(`${baseUrl}/index.php?page=apply-discount`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                code: discountCode,
                provisional: provisionalPrice
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    discountMessage.style.color = '#28a745';
                    document.getElementById('discount-id').value = data.discountId;

                    const transportFee = parseInt(document.querySelector('.transport-fee__price--hidden').value);
                    document.querySelector('.provisional-price').textContent = new Intl.NumberFormat().format(data.newProvisionalPrice) + 'đ';

                    const newTotal = data.newProvisionalPrice + transportFee;
                    document.getElementById('total-payment').textContent = new Intl.NumberFormat().format(newTotal) + 'đ';
                    document.getElementById('total-payment-hidden').value = newTotal;
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
