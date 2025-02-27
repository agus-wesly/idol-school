<?php require("../shared/top.php") ?>
<?php require("../shared/navbar.php") ?>

<div class="my-3">
    <h3 class="text-center fw-bold mb-5">Activities</h3>
    <div id="container" class="row my-3 gap-3">
    </div>
</div>

<?php require("../shared/script.php") ?>
<script>
    $.ajax({
        type: "GET",
        url: "../controller/activities/get_activities.php",
        contentType: "application/json",
        success: function(data) {
            $.each(data, function(_, item) {
                const el = `
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title fw-bold">
                        ${item.title}
                        ${item.is_new == 1 
                            ? "<span class='badge rounded-pill text-bg-info'>New</span>"
                            : ""}
                    </h5>
                        <p class="card-text">${item.content}</p>
                    </div>
                </div>`
                $('#container').append(el)
            })
        },
        error: function(data) {
            console.error(data)
        }
    });
</script>
<?php require("../shared/bottom.php") ?>
