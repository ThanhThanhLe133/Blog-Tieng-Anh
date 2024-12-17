$(document).ready(function () {
    var urlParams = new URLSearchParams(window.location.search);
    var blog_id = urlParams.get('blog_id');
    if (blog_id !== null) {
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
    $("#btnSaveBlog").on('click', function () {
        var content = $(".ql-editor").html();
        var title = $("#title").val();
        var category_id = $("#category").val();
        if (!title.trim() || content.trim() === "<p><br></p>") {
            $("#custom-alert .message").text("Vui lòng nhập tiêu đề và nội dung.");
            $("#custom-alert").show();
            return;
        }

        $.post('post_blog.php', { title: title, category_id: category_id, blog_id: blog_id }, function (response) {
            if (response.includes('Lỗi') || response.includes('Category không tồn tại')) {
                return;
            } else {
                var blog_id_new = response;
                blog_id = blog_id_new;
                var image_title = $('#image_title')[0].files[0];
                uploadBlog(blog_id_new, image_title, content);
            }
        });
    });
    $("#addBlog").on('click', function() {
        window.open("../TaoBlog/index.php", "_blank");
    });

    $(".btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
        $("#custom-close").hide();
        if ($("#custom-alert .message").text().includes("thành công")) {
            window.location.href="../TaoBlog/index.php?blog_id=" + blog_id, '_blank';
        }        
    });
    function displayBlog(blog_id) {
        $.post("load_blog.php", { blog_id: blog_id }, function (response) {
            $('#blog_editor').empty().append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function uploadBlog(blogId, image_title, content) {
        var formData = new FormData();
        formData.append('image_title', image_title);
        formData.append('blog_id', blogId);
        formData.append('content', content);

        // AJAX gửi dữ liệu đến PHP
        $.ajax({
            url: 'upload_blog.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.includes('success')) {
                    $("#custom-alert .message").text("Blog đã được tải lên thành công!");
                } else {
                    $("#custom-alert .message").text("Lỗi: " + response);
                }
                $("#custom-alert").show();
            },
            error: function (xhr, status, error) {
                $("#custom-alert .message").text("Lỗi khi tải lên: " + error);
                $("#custom-alert").show();
            }
        });
    }
})
