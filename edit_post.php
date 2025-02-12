<?php
include 'config.php';
include '.includes/header.php';

$postIdToEdit = $_GET['post_id'];

$query = "SELECT * FROM posts WHERE id_post = $postIdToEdit";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "Post not found.";
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                        <input type="hidden" name="post_id" value="<?php echo $postIdToEdit; ?>">
                        <div class="mb-3">
                        <label for="post_title" class="form-label">Judul Postingan</label>
                        <input value="<?php echo $post['post_title']; ?>" type="text" class="form-control" name="post_title" required>


                     </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Unggah Gambar</label>
                            <input class="form-control" type="file" id="formFile" name="image_path" accept="image/*">
                            <?php if (!empty($post['image_path'])): ?>
                                <div class="mt-2">
                                    <img src="<?= $post['image_path']; ?>" alt="CurrentImage" class="img-thumbnail" style="max-widht: 200px;">
                                </div>
                                <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Select one</option>
                                <?php
                             $query = "SELECT * FROM categories"; // Query untuk mengambil data kategori
                             $result = $conn->query($query); // Menjalankan query
                             if ($result->num_rows > 0) { // jika terdapat data kategori
                                while ($row = $result->fetch_assoc()) { // Iterasi setiap kategori
                                    echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                                    }
                             }
                             ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control" id="content" name="content" required><?php echo $post['content']; ?></textarea>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Memasukkan footer halaman
include '.includes/footer.php';
?>