<div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
    <div style="background-color: #d09a40; color: white; padding: 20px; text-align: center;">
        <h1 style="margin: 0;">Ngũ Long Bakery</h1>
        <p style="margin: 0;">Hóa đơn đặt hàng của bạn</p>
    </div>
    <div style="padding: 20px;">
        <p style="margin-bottom: 10px;">Xin chào <strong><?= $fullname ?></strong>,</p>
        <p style="margin-bottom: 20px;">Cảm ơn bạn đã đặt hàng tại <strong>Ngũ Long Bakery</strong>. Dưới đây là thông tin đơn hàng của bạn:</p>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #f5f5f5;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Sản phẩm</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Số lượng</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Đơn giá</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?= $orderDetails ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Giảm giá:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><?= $discount ? $discount . '%' : 'Không có' ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Phí vận chuyển:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><?=number_format($transportFee, 0, ',', '.')?>đ</td>
                </tr>
                <tr style="background-color: #f5f5f5;">
                    <td colspan="3" style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong>Tổng cộng:</strong></td>
                    <td style="text-align: right; padding: 10px; border: 1px solid #ddd;"><strong><?=number_format($total, 0, ',', '.')?>đ</strong></td>
                </tr>
            </tfoot>
        </table>
        <p style="margin-bottom: 5px;"><strong>Địa chỉ giao hàng: </strong><?=$address?></p>
        <p style="margin-bottom: 5px;"><strong>Số điện thoại: </strong><?=$phone?></p>
        <p style="margin-bottom: 5px;"><strong>Phương thức thanh toán: </strong><?=$method?></p>
        <?php if ($note): ?>
            <p style="margin-bottom: 20px;"><strong>Ghi chú: </strong><?=$note?></p>
        <?php endif; ?>
        <p style="margin: 20px 0; text-align: center;">
            <strong>Ngũ Long Bakery</strong> xin chân thành cảm ơn và hân hạnh được phục vụ quý khách!
        </p>
    </div>
    <div style="background-color: #f5f5f5; padding: 10px; text-align: center;">
        <p style="margin: 0;">Ngũ Long Bakery - Hương vị truyền thống, lan toả yêu thương</p>
        <p style="margin: 0;">📍 QTSC 9, CVPM Quang Trung, Quận 12, TP. Hồ Chí Minh</p>
        <p style="margin: 0;">📞 082 828 3169 | 🌐 <a href="https://ngulongbakery.store" style="color: #d09a40; text-decoration: none;">ngulongbakery.store</a></p>
    </div>
</div>
