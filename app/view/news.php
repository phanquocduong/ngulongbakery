
<!-- Start Main -->
<!-- <main>
    <div class="title-news">Tin tức</div>
    <section class="news-list">
        <div class="grid wide">
            <div class="row">
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $newsItem): ?>
                    <div class="col l-4 m-6 c-10 c-offset-1">
                        <div class="news-item">
                            <a href="<?= htmlspecialchars($newsItem['link']) ?>" class="news-item__img-link">
                                <img
                                    src="<?= htmlspecialchars($newsItem['img']) ?>"
                                    alt="<?= htmlspecialchars($newsItem['title']) ?>"
                                    class="news-item__img"
                                />
                                <div class="overlay"></div>
                            </a>
                            <a href="<?= htmlspecialchars($newsItem['link']) ?>" class="news-item__title-link">
                                <div class="news-item__name">
                                    <?= htmlspecialchars($newsItem['title']) ?>
                                </div>
                            </a>
                            <div class="news-item__description">
                                <?= htmlspecialchars($newsItem['description']) ?>
                            </div>
                            <a href="<?= htmlspecialchars($newsItem['link']) ?>" class="news-item__readmore-link">
                                <div class="news-item__readmore">
                                    ĐỌC THÊM <i class="fa-solid fa-angles-right"></i>
                                </div>
                            </a>
                            <div class="news-item__line"></div>
                            <div class="news-item__comment">
                                <div class="news-item__comment-date"><?= htmlspecialchars($newsItem['date']) ?></div>
                                <i class="fa-solid fa-circle"></i>
                                <div class="news-item__comment-content"><?= htmlspecialchars($newsItem['comments']) ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col l-12">
                        <div class="no-news-message">Không có tin tức nào để hiển thị.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <div class="pageorder">
        <button class="loading-btn" onclick="showLoading(this)">
            <span class="button-text">Xem thêm</span>
            <span class="spinner"></span>
        </button>
    </div>
</main> -->
<!-- End Main -->


<?php
$dsn = 'mysql:host=localhost;dbname=ngulongbakery;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Kết nối thất bại: ' . $e->getMessage();
}
?>

<?php
// Truy vấn dữ liệu từ bảng news
$stmt = $pdo->query("SELECT img, title, description, date, comments FROM news");
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Start Main -->
<main>
    <div class="title-news">Tin tức</div>
    <section class="news-list">
        <div class="grid wide">
            <div class="row">
                <?php foreach ($news as $newsItem): ?>
                <div class="col l-4 m-6 c-10 c-offset-1">
                    <div class="news-item">
                        <a href="" class="news-item__img-link">
                            <img
                                src="<?= htmlspecialchars($newsItem['img']) ?>"
                                alt="Ảnh sản phẩm"
                                class="news-item__img"
                            />
                            <div class="overlay"></div>
                        </a>
                        <a href="" class="news-item__title-link">
                            <div class="news-item__name">
                                <?= htmlspecialchars($newsItem['title']) ?>
                            </div>
                        </a>
                        <div class="news-item__description">
                            <?= htmlspecialchars($newsItem['description']) ?>
                        </div>
                        <a href="" class="news-item__readmore-link">
                            <div class="news-item__readmore">
                                ĐỌC THÊM <i class="fa-solid fa-angles-right"></i>
                            </div>
                        </a>
                        <div class="news-item__line"></div>
                        <div class="news-item__comment">
                            <div class="news-item__comment-date"><?= htmlspecialchars($newsItem['date']) ?></div>
                            <i class="fa-solid fa-circle"></i>
                            <div class="news-item__comment-content"><?= htmlspecialchars($newsItem['comments']) ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <div class="pageorder">
        <button class="loading-btn" onclick="showLoading(this)">
            <span class="button-text">Xem thêm</span>
            <span class="spinner"></span>
        </button>
    </div>
</main>
<!-- End Main -->

