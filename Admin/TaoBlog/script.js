$(document).ready(function () {
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

    quill.on('text-change', function () {
        $("#content").val(quill.root.innerHTML);
    });
    $(".btnSaveBlog").on('click', function (e) {
        e.preventDefault();
        var content = $(".ql-editor").html();
        var title = $("#title").val();
        var category = $("#category").val();
        if (!title.trim() || content.trim() === "<p><br></p>") {
            $("#custom-alert .message").text("Vui lòng nhập tiêu đề và nội dung.");
            $("#custom-alert").show();
            return;
        }
        $.post('post_blog.php', { title: title,category:category}, function (response) {
            if (response.includes('Error') || response.includes('Category không tồn tại')) {
                alert(response);
            } else {
                var blog_id = response;
                
                $.post('upload_content.php', {blog_id:blog_id,content:content}, function (response) {
                    if (response.includes('success')) {
                        alert('Content uploaded successfully!');
                    } else {
                        alert('Error uploading content: ' + response);
                    }
                });
            }
        });
    });
    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
        $("#custom-close").hide();
    });
})


// Hàm tải lên hình ảnh cho blog
function uploadImages(blogId, blobs) {
    var formData = new FormData();

    formData.append('blog_id', blogId);

    blobs.forEach((blob, index) => {
        var reader = new FileReader();
        reader.onloadend = function () {
            var base64Image = reader.result.split(',')[1];

            formData.append('images[]', base64Image);

            if (index === blobs.length - 1) {
                $.post('upload_image.php', formData, function (response) {
                    if (response === 'success') {
                        alert("Images uploaded and saved successfully!");
                    } else {
                        alert("Image upload failed!");
                    }
                });
            }
        };

        reader.readAsDataURL(blob);
    });
}

// Khi nhấn nút Lưu


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