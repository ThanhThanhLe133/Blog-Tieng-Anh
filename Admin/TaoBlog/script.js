$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var blog_id = urlParams.get('blog_id');
    if(blog_id!==null){
        displayBlog(blog_id);
    }
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
        var category_id = $("#category").val();
        if (!title.trim() || content.trim() === "<p><br></p>") {
            $("#custom-alert .message").text("Vui lòng nhập tiêu đề và nội dung.");
            $("#custom-alert").show();
            return;
        }
        $.post('post_blog.php', { title: title, category_id: category_id,blog_id:blog_id }, function (response) {
            if (response.includes('Error') || response.includes('Category không tồn tại')) {
                alert(response);
            } else {
                var blog_id = response;
                var formData = new FormData();
                formData.append('image_title', $('#image_title')[0].files[0]);  // Thêm ảnh vào form data
                formData.append('blog_id', blog_id);
                $.ajax({
                    url: 'upload_image_title.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                    },
                    error: function (xhr, status, error) {
                        $("#custom-alert .message").text("Error uploading file: " + error);
                        $("#custom-alert").show();
                        return;
                    }
                });

                $.post('upload_content.php', { blog_id: blog_id, content: content }, function (response) {
                    if (response.includes('success')) {
                        $("#custom-alert .message").text("Đã tạo blog mới thành công!");
                        $("#custom-alert").show();
                    } else {
                        $("#custom-alert .message").text('Lỗi khi tạo content blog: ' + response);
                        $("#custom-alert").show();
                    }
                });
            }
        });
    });
    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
        $("#custom-close").hide();
        window.scrollTo(0, 0);
        location.reload();
    });
    function displayBlog(blog_id) {
        $.post("load_blog.php", { blog_id: blog_id }, function (response) {
            $('#blog_editor').empty().append(response); 
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
})
