<?php require("../shared/top.php") ?>
<?php require("../shared/navbar.php") ?>

<div class="my-3">
    <h3>News</h3>
    <div id="container" class="row my-3">
    </div>
</div>

<?php require("../shared/script.php") ?>
<script>
    $.ajax({
        type: "GET",
        url: "../controller/news/get_news.php",
        contentType: "application/json",
        success: function(data) {
            $.each(data, function(_, item) {
                console.log(item)
                const el = `<div class="col-lg-6 col-sm-12 mb-4">
                <div class="card" style="">
                  <img src=${item.img_url} class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">${item.title}</h5>
                    
                    <p class="card-text py-2 fw-bold">Kategori : ${item.kategori}</p>

                    <p class="card-text">${item.content.slice(0,75)}...</p>
                        <a href="/news_detail?id=${item.id}" class="btn btn-secondary">See more</a>
                  </div>
                </div>
            </div>
            `
                $("#container").append(el)
            })
        },
        error: function(data) {
            console.error(data)
        }
    });
</script>
<?php require("../shared/bottom.php") ?>
