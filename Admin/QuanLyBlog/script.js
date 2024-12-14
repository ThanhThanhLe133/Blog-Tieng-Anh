$(document).ready(function () {

    // Khởi tạo Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }, { 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Cập nhật nội dung Quill vào trường ẩn khi có thay đổi
    quill.on('text-change', function () {
        $("#content").val(quill.root.innerHTML);
    });

    // Hàm tải lên hình ảnh
    function uploadImage(blob) {
        var formData = new FormData();
        formData.append('file', blob);
        return $.ajax({
            url: 'upload_image.php',  // Tạo file PHP xử lý tải lên hình ảnh
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        });
    }

    // Khi nhấn nút Lưu
    $("#btnSave").on('click', function (e) {
        e.preventDefault();

        var content = $("#content").val();  // Lấy nội dung từ trường ẩn
        var title = $("#title").val();  // Lấy tiêu đề từ input

        // Kiểm tra xem có nhập đủ tiêu đề và nội dung hay không
    	if (!title.trim() || content.trim() === "<p><br></p>") {
           $("#custom-alert .message").text("Vui lòng nhập tiêu đề và nội dung.");
           $("#custom-alert").show();
           return;
    	}

        // Tìm tất cả hình ảnh trong nội dung
        var images = $(content).find('img');
        var imagePromises = [];

        // Duyệt qua tất cả các hình ảnh để tải lên
        images.each(function (index, img) {
            var blob = dataURItoBlob(img.src);  // Chuyển đổi data URL thành blob
            var promise = uploadImage(blob).then(function (response) {
                // Thay đổi src của hình ảnh thành URL đã upload
                $(img).attr('src', response);
            });
            imagePromises.push(promise);
        });

        // Đợi tất cả hình ảnh tải lên xong trước khi lưu bài viết
        Promise.all(imagePromises).then(function () {
            // Gửi dữ liệu qua AJAX
            $.post("submitblog.php", {
                title: title,
                content: content  // Gửi nội dung từ trường ẩn
            }, function (response) {
                if (response.includes("Thành công")) {
                    // Thông báo thành công
                    $("#custom-alert .message").text("Bài viết đã được lưu thành công!");
                    $("#custom-alert").fadeIn();

                    // Xóa tiêu đề và nội dung sau khi lưu thành công
                    $("#title").val("");
                    quill.root.innerHTML = "<p><br></p>";
                    $("#content").val("<p><br></p>");

                    // Đóng hộp thông báo sau 3 giây
                    setTimeout(function () {
                        $("#custom-alert").fadeOut();
                    }, 3000);
                } else {
                    // Thông báo lỗi
                    $("#custom-alert .message").text("Có lỗi xảy ra: " + response);
                    $("#custom-alert").fadeIn();

                    // Đóng hộp thông báo sau 3 giây
                    setTimeout(function () {
                        $("#custom-alert").fadeOut();
                    }, 3000);
                }
            }).fail(function () {
                // Thông báo lỗi nếu AJAX thất bại
                $("#custom-alert .message").text("Có lỗi xảy ra, vui lòng thử lại.");
                $("#custom-alert").fadeIn();

                // Đóng hộp thông báo sau 3 giây
                setTimeout(function () {
                    $("#custom-alert").fadeOut();
                }, 3000);
            });
        });
    });
    
});

// Hàm chuyển đổi Data URL thành Blob
function dataURItoBlob(dataURI) {
    var byteString = atob(dataURI.split(',')[1]);
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]; // Lấy loại MIME
    var arrayBuffer = new ArrayBuffer(byteString.length);
    var uint8Array = new Uint8Array(arrayBuffer);
    for (var i = 0; i < byteString.length; i++) {
        uint8Array[i] = byteString.charCodeAt(i);
    }
    return new Blob([uint8Array], { type: mimeString });
}
