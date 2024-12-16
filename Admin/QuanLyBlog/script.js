$(document).ready(function () {
    //load ds blogs
    displayBlogData();
    $(".addBlog").on("click", function () {
        window.location.href = "../TaoBlog/index.php";
    })
    loadFilterBox();
    //xử lý xoá
    $('#blog-table').on('click', '.deleteBtn', function () {
        var row = $(this).closest('tr');
        var blog_id = row.data('blog_id');

        $("#custom-close .message").html("Bạn có chắc chắn muốn xoá blog này?");
        $("#custom-close").show();
        $(".btn-ok").on('click', function (e) {
            e.preventDefault();
            $("#custom-close").hide()
            $.post('deleteBlog.php', { blog_id: blog_id }, function (response) {
                if (response.includes('success')) {
                    row.remove();
                    $("#custom-alert").show();
                } else {
                    $("#custom-alert .message").text(response);
                    $("#custom-alert").show();
                }
            });
        });
    });
    $("#custom-alert .btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-alert").hide();
        location.reload();
    });
    $("#custom-close .btn-close").on("click", function (e) {
        e.preventDefault();
        $("#custom-close").hide();
    });
    //xử lý edit
    $('#blog-table').on('click', '.editBtn', function () {
        var row = $(this).closest('tr');
        var blog_id = row.data('blog_id');
        window.open("../TaoBlog/index.php?blog_id=" + blog_id, '_blank');
    });

    //nút tìm kiếm
    $('#search-input').on('keyup', function () {
        var searchTerm = $(this).val().toLowerCase();
        $('#blog-table tr').each(function () {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchTerm) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });


    $('#search-input').keydown(function (e) {
        if (e.which === 13) {
            var searchTerm = $(this).val().toLowerCase();
            $('#blog-table tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });

    // Mở/đóng hộp lọc khi nhấn nút Lọc
    $('#filterButton').on("click", function () {
        $('#filterBox').slideToggle(300);
    });
    $('#closeFilter').on("click", function () {
        $('#filterBox').hide();
    });


    // Áp dụng bộ lọc khi nhấn nút Áp dụng
    $('#applyFilter').on("click", function () {
        var filterAuthor = $('#authorCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var filterCreatedDate = $('#CreatedDateCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var filterUpdatedDate = $('#UpdatedDateCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var filterCategory = $('#CategoryCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        $('#filterBox').hide();
        $('#blog-table tr').each(function () {
            var row = $(this);

            var rowAuthor = row.find('.author').text();
            var rowCreated_at = row.find('.created_at').text()
            var rowUpdated_at = row.find('.updated_at').text();
            var rowCategory = row.find('.category').text();

            var isAuthorMatch = filterAuthor.includes(rowAuthor);
            var isCreated_atMatch = filterCreatedDate.includes(rowCreated_at);
            var isUpdated_atMatch = filterUpdatedDate.includes(rowUpdated_at);
            var isCategory = filterCategory.includes(rowCategory);
            console.log(isCreated_atMatch,isUpdated_atMatch,isCategory);
            if (isAuthorMatch || isCreated_atMatch || isUpdated_atMatch || isCategory) {
                row.show();
            } else {
                row.hide();
            }
        });
    });

    // Mở/đóng hộp sắp xếp khi nhấn nút sắp xếp
    $('#sortButton').on("click", function () {
        $('#sortBox').slideToggle(300);
    });
    $('#applySortAZ').on('click', function () {
        var sortKey = $("#sortSelect").val();

        $("#sortBox").hide();
        if (sortKey) {
            var rows = $('#blog-table tr').get();
            rows.sort(function (a, b) {
                var keyA = $(a).children(`.${sortKey}`).text().toLowerCase();
                var keyB = $(b).children(`.${sortKey}`).text().toLowerCase();

                if (keyA < keyB) return -1;
                if (keyA > keyB) return 1;
                return 0;
            });
            $.each(rows, function (index, row) {
                $('#blog-table').append(row);
            });
        }
        else {
            alert("Vui lòng chọn một cột để sắp xếp!");
        }
    });

    $('#applySortZA').on('click', function () {
        var sortKey = $("#sortSelect").val();
        $("#sortBox").hide();
        if (sortKey) {
            var rows = $('#blog-table tr').get();
            rows.sort(function (a, b) {
                var keyA = $(a).children(`.${sortKey}`).text().toLowerCase();
                var keyB = $(b).children(`.${sortKey}`).text().toLowerCase();

                if (keyA < keyB) return 1;
                if (keyA > keyB) return -1;
                return 0;
            });
            $.each(rows, function (index, row) {
                $('#blog-table').append(row);
            });
        }
        else {
            alert("Vui lòng chọn một cột để sắp xếp!");
        }
    });
    function displayBlogData() {
        $.post("getData.php", {}, function (response) {
            $('#blog-table').append(response);
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function loadFilterBox() {
        $.post("getFilterBoxForAuthor.php", {}, function (response) {
            $('#authorCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForCreatedDate.php", {}, function (response) {
            $('#CreatedDateCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForUpdatedDate.php", {}, function (response) {
            $('#UpdatedDateCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
    }

});
