
$(document).ready(function () {
    let isUserLoggedIn = false;
    let isAdminLoggedIn = false;
    var urlParams = new URLSearchParams(window.location.search);
    var blog_id = urlParams.get('blog_id');

    displayBlog(blog_id);
    displayComment(blog_id);
    displayLatestBlog();
    displayRelatedBlog(blog_id);
    displayPrevNext(blog_id);
    checkIsUserLogin();
    checkIsAdminLogin();

    //bình luận
    $(".send").on("click", function (event) {
        event.preventDefault();

        if (!isUserLoggedIn) {
            $("#custom-close").show();
            $(".btn-ok").one("click", function () {
                window.location.href = "../../../../user/login/index.php";
            });
            return;
        }

        let comment = $(".content-comment").val();
        if (comment === "") {
            $("#custom-alert .message").text("Bình luận không được để trống!");
            $("#custom-alert").show();
            return;
        }

        $.post("postComment.php", { comment: comment, blog_id: blog_id }, function (response) {
            $('.commentArea').append(response);
            $("#custom-alert .message").text("Bình luận thành công!");
            $("#custom-alert").show();
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });

        $(".content-comment").val("");
    });
    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
        $("#custom-close").hide();
    });

    function displayBlog(blog_id) {
        $.post("load_blog.php", { blog_id: blog_id }, function (response) {
            $('#blogPost').empty().append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayComment(blog_id) {
        $.post("load_comment.php", { blog_id: blog_id }, function (response) {
            $('.commentArea').empty().append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayLatestBlog() {
        $.post("load_latest_blog.php", {}, function (response) {
            $('#latestBlog').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayRelatedBlog() {
        $.post("../load_related_blog.php", { blog_id: blog_id }, function (response) {
            $('#relatedBlog').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayPrevNext() {
        $.post("load_prev_next.php", { blog_id: blog_id }, function (response) {
            $('#prev_next').empty().append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }

    function checkIsUserLogin() {
        $.post("../../../isUserLogin.php", {}, function (response) {
            if (response.includes("yes")) {
                isUserLoggedIn = true;
            }
        });
    }
    function checkIsAdminLogin() {
        $.post("../../../isAdminLogin.php", {}, function (response) {
            if (response.includes("yes")) {
                isAdminLoggedIn = true;
                if (isAdminLoggedIn === true) {
                    $(".deleteBtn").css("display", "block");
                    $(".deleteBtn").on("click", function () {

                        var commentArea = $(this).closest('.comment');
                        var comment_id = commentArea.data('comment_id');
                        var blog_id = commentArea.closest('.blog').data('blog_id');
                        $.post("deleteComment.php", { comment_id: comment_id, blog_id: blog_id }, function (response) {
                            if (response.includes("success")) {
                                $('.commentArea').append(response);
                                $("#custom-alert .message").text("Xoá bình luận thành công!");
                                $("#custom-alert").show();

                                $(".btn-close").on("click", function (e) {
                                    e.preventDefault();
                                    $("#custom-alert").hide();
                                    location.reload();
                                });
                            }
                            else {
                                $("#custom-alert .message").text(response);
                                $("#custom-alert").show();
                            }
                        });
                    });
                }
            }
        });
    }

});
