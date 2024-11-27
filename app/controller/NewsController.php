<?php
class NewsController {
    private $news;
    private $comments;
    private $category;

    function __construct() {
        $this->news = new PostModel();
        $this->comments = new CommentsModel();
        $this->category = new CategoryModel();
    }

    private function renderView($view, $css, $js, $data = []) {
        $categories = $this->category->getCategories("WHERE type = 'Sản phẩm' AND status = 1", []);
        require_once 'app/view/template.php';
    }

    public function viewNews($css, $js) {
        $newsList = $this->news->getPost();
        foreach ($newsList as &$news) {
            $news['total_comments'] = $this->comments->totalComments($news['id']);
        }
        $data['news'] = $newsList;
        $this->renderView('news', $css, $js, $data);
    }

    public function viewNewsDetail($css, $js) {
        // Lấy id bài viết từ URL
        $id = $_GET['id'] ?? 1;
        $news = $this->news->getIdPost($id);
        $totalPosts = $this->news->getTotalPosts(); // Lấy tổng số bài viết
        $data['news-details'] = $news;
        $data['totalPosts'] = $totalPosts; // Truyền tổng số bài viết vào view
        $this->renderView('news-details', $css, $js, $data);
    }

    public function viewComments() {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $comments = $this->news->getCommentsByPostId($id);
        if (is_array($comments)) {
            $this->data['comments'] = $comments;
            $this->renderview('comments', $this->data);
        } else {
            echo "Not found....";
        }
    }

    public function addComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = (int) $_POST['post_id']; // Lấy post_id từ form
            $comment = htmlspecialchars(trim($_POST['comment']));
            $user_id = $_SESSION['user']['id'];

            if (empty($comment)) {
                die("Nội dung bình luận không được để trống!");
            }
            $data = [
                'comment' => $comment,
                'user_id' => $user_id,
                'post_id' => $post_id
            ];
            $this->comments->insertComment($data);
            echo '<script>location.href="index.php?page=news-details&id='.$post_id.'#quantitycmt"</script>';
        }   
    }
}