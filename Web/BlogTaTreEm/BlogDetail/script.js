
$(document).ready(function () {
    const isUserLoggedIn = false;
    const isAdminLoggedIn = false;
    //bình luận
    $(".send").on("click", function (event) {  
        event.preventDefault();


        if (!isLoggedIn) {
            $("#custom-close").show();
            $("#btn-ok").on("click", function(){
                window.location.href = "../../user/login.php"; 
            });
        }
        // const reviewContent = $(".content-review").val();
        // if (reviewContent.trim() === "") {
        //     alert("Nội dung đánh giá không được để trống!");
        //     return;
        // }
        // alert("Đánh giá của bạn đã được gửi!"); 
        let username = $(".username").val();
        let review = $(".content-review").val();

        let user = {
            username: username,
            time: formatDay(new Date()),
            review: review
        };
        let text =
            `<div class="comment">
        <div>@<span class="name">${user.username}</span></div>
        <div class="datetime">${user.time}</div>
        <div class="review">${user.review}</div>
            </div>`

        $(".review-area").last().append(text);

        $(".username").val("");
        $(".content-review").val("");
    });

    var urlParams = new URLSearchParams(window.location.search);
    var blog_id = urlParams.get('blog_id');

    displayBlog(blog_id);
    displayLatestBlog();
    displayRelatedBlog(blog_id);
    displayPrevNext(blog_id);
    checkIsUserLogin();
    checkIsAdminLogin();
    function displayBlog(blog_id) {
        $.post("load_blog.php", { blog_id: blog_id }, function (response) {
            $('#blogPost').empty().append(response); 
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayLatestBlog() {
        $.post("../load_latest_blog.php", {}, function (response) {
            $('#latestBlog').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function displayRelatedBlog() {
        $.post("../load_related_blog.php", {blog_id: blog_id }, function (response) {
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
    function formatDay(date) {
        const days = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
        const hour = date.getHours().toString().padStart(2, "0");
        const minute = date.getMinutes().toString().padStart(2, "0");
        const day = date.getDate().toString().padStart(2, "0");
        const month = (date.getMonth() + 1).toString().padStart(2, "0");
        const year = date.getFullYear();

        return `${hour}:${minute} ${days[date.getDate()]} ngày ${day}/${month}/${year}`;
    }
    function checkIsUserLogin(){
        $.post("../../isUserLogin.php", { }, function (response) {
            if(response.include("yes")){
                isUserLoggedIn=true;
            }
        });
    }
    function checkIsAdminLogin(){
        $.post("../../isLogin.php", { }, function (response) {
            if(response.include("yes")){
                isAdminLoggedIn=true;
            }
        });
    }
})
