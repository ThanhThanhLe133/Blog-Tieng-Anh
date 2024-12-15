
$(document).ready(function () {
    function formatDay(date) {
        const days = ["Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy"];
        const hour = date.getHours().toString().padStart(2, "0");
        const minute = date.getMinutes().toString().padStart(2, "0");
        const day = date.getDate().toString().padStart(2, "0");
        const month = (date.getMonth() + 1).toString().padStart(2, "0");
        const year = date.getFullYear();

        return `${hour}:${minute} ${days[date.getDate()]} ngày ${day}/${month}/${year}`;
    }

    //bình luận
    $(".send").on("click", function (event) {  
        event.preventDefault();

        const isLoggedIn = false;
        if (!isLoggedIn) {
            alert("Bạn cần đăng nhập để gửi đánh giá!");
            window.location.href = "/login"; 

            const reviewContent = $(".content-review").val();
            if (reviewContent.trim() === "") {
                alert("Nội dung đánh giá không được để trống!");
                return;
            }
            alert("Đánh giá của bạn đã được gửi!"); 
        }

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

})
