<?php
$id = $_GET["id"];
if (!isset($id)) {
    require("../shared/not-found.php");
} else {
    require("../shared/top.php");
    require("../shared/navbar.php");
    require("../shared/script.php")
?>
    <div class="my-3" id="container">
        <a href="/news">Back to all news</a>
    </div>
    <script>
        const id = new URLSearchParams(window.location.search).get("id")
        $.ajax({
            type: "GET",
            url: `../controller/news/get_news_detail.php?id=${id}`,
            contentType: "application/json",
            success: function(data) {
                const el = `
                <div class="my-3">
                    <img src=${data.result.img_url} alt="cover" class="w-100 mb-5" />
                    <h3 class="fw-bold mb-3">${data.result.title}</h3>

                    <p class="fw-bold">Kategori : ${data.result.kategori}</p>

                    <p>${data.result.content.slice(0,350)}</p>
                    <p>${data.result.content.slice(300,data.result.content.length)}</p>
                </div>
            `
                $("#container").append(el)
            },
            error: function(data) {
                console.error(data)
                const el = `
                <div class="my-3">
                    <h3>Not found</h3>
                    <p>The requested url cannot be found</p>
                </div>
            `
                $("#container").append(el)
            }
        });
    </script>
<?php } ?>
<?php require("../shared/bottom.php") ?>
