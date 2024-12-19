$(document).ready(function () {
    //load ds user
    displayUserData();
    loadFilterBox();
    var originalRows = [];
    //nút tìm kiếm
    $('#search-input').on('keyup', function () {
        var searchTerm = $(this).val().toLowerCase();
        $('#user-table tr').each(function () {
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
            $('#user-table tr').each(function () {
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
    $('#close').on("click", function () {
        $('#filterBox').hide();
        $('#sortBox').hide();
    });


    // Áp dụng bộ lọc khi nhấn nút Áp dụng
    $('#applyFilter').on("click", function () {
        var birthYearFilters = $('#birthYearCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var firstNameFilters = $('#firstNameCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var lastNameFilters = $('#lastNameCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var schoolFilters = $('#SchoolCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get();
        var dateFilters = $('#filterDate input:checked').map(function () {
            return $(this).val();
        }).get();
        var statusFilter = $('#StatusCheckboxes input:checked').map(function () {
            return $(this).val();
        }).get()
        $('#filterBox').hide();
        $('#user-table tr').each(function () {
            var row = $(this);
            var rowBirthYear = row.find('.birthYear').text();
            var rowFirstName = row.find('.firstName').text();
            var rowLastName = row.find('.lastName').text();
            var rowSchool = row.find('.studySchool').text();
            var rowDate = row.find('.formattedDate').text();
            var rowStatus = row.find('.approval_status').text();
            
            var isBirthYearMatch = birthYearFilters.includes(rowBirthYear);
            var isFirstNameMatch = firstNameFilters.includes(rowFirstName);
            var isLastNameMatch = lastNameFilters.includes(rowLastName);
            var isSchoolMatch = schoolFilters.includes(rowSchool);

            var isDateMatch = dateFilters.some(function (filterDate) {
                var rowDateMatch = extractDate(rowDate); 
                return rowDateMatch === filterDate; 
            });
            
            var isStatusMatch = statusFilter.includes(rowStatus);
            if (isBirthYearMatch || isFirstNameMatch || isLastNameMatch || isSchoolMatch ||isStatusMatch) {
                row.show();
            } else {
                row.hide();
            }
            if(isDateMatch===true)
            {
                row.show();
            }
        });
    });
    $("#closeSort").on("click", function () {
        $('#sortBox').hide();
    });
    // Mở/đóng hộp sắp xếp khi nhấn nút sắp xếp
    $('#sortButton').on("click", function () {
        $('#sortBox').slideToggle(300);
    });
    $('#applySortAZ').on('click', function () {
        var sortKey = $("#sortSelect").val();
        $("#sortBox").hide();
        if (sortKey) {
            if (sortKey === "created_at") {
                var rows = $('#user-table tr').get();
                rows.sort(function (a, b) {
                    var keyA = $(a).children(`.${sortKey}`).text().trim();
                    var keyB = $(b).children(`.${sortKey}`).text().trim();

                    var dateA = convertToDate(keyA);
                    var dateB = convertToDate(keyB);

                    if (dateA < dateB) return 1;
                    if (dateA > dateB) return -1;
                    return 0;
                });
            }
            else {
                var rows = $('#user-table tr').get();
                rows.sort(function (a, b) {
                    var keyA = $(a).children(`.${sortKey}`).text().toLowerCase();
                    var keyB = $(b).children(`.${sortKey}`).text().toLowerCase();

                    if (keyA < keyB) return -1;
                    if (keyA > keyB) return 1;
                    return 0;
                });
            }

            $.each(rows, function (index, row) {
                $('#user-table').append(row);
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
            if (sortKey === "created_at") {
                var rows = $('#user-table tr').get();
                rows.sort(function (a, b) {
                    var keyA = $(a).children(`.${sortKey}`).text().trim();
                    var keyB = $(b).children(`.${sortKey}`).text().trim();

                    var dateA = convertToDate(keyA);
                    var dateB = convertToDate(keyB);

                    if (dateA < dateB) return -1;
                    if (dateA > dateB) return 1;
                    return 0;
                });
            }
            else {
                var rows = $('#user-table tr').get();
                rows.sort(function (a, b) {
                    var keyA = $(a).children(`.${sortKey}`).text().toLowerCase();
                    var keyB = $(b).children(`.${sortKey}`).text().toLowerCase();

                    if (keyA < keyB) return 1;
                    if (keyA > keyB) return -1;
                    return 0;
                });
            }
            $.each(rows, function (index, row) {
                $('#user-table').append(row);
            });
        }
        else {
            alert("Vui lòng chọn một cột để sắp xếp!");
        }
    });
    $('#cancelSort').on('click', function () {
        $("#sortBox").hide();
        $('#user-table').empty();
        $.each(originalRows, function (index, row) {
            $('#user-table').append(row);
        });
        $("#sortSelect").val("");
    });
    //xử lý xoá
    $('#user-table').on('click', '.deleteBtn', function () {
        var row = $(this).closest('tr');
        var users_id = row.data('users_id');

        $("#custom-close .message").html("Bạn có chắc chắn muốn xoá người dùng này?");
        $("#custom-close").show();
        $(".btn-ok").on('click', function (e) {
            e.preventDefault();
            $("#custom-close").hide();
            $.post('deleteUser.php', { users_id: users_id }, function (response) {
                if (response.includes('success')) {
                    row.remove();
                    $("#custom-alert").show();
                } else {
                    $("#custom-alert .message").text('Xóa thất bại. Vui lòng thử lại.');
                    $("#custom-alert").show();
                }
            });
        });
    });

    //xử lý approve
    $('#user-table').on('click', '.approveBtn', function () {
        var row = $(this).closest('tr');
        var users_id = row.data('users_id');

        $("#custom-close .message").html("Bạn có chắc chắn muốn duyệt người dùng này?");
        $("#custom-close").show();
        $(".btn-ok").on('click', function (e) {
            $("#custom-alert").hide();
            e.preventDefault();
            $("#custom-close").hide();

            $.post('approveUser.php', { users_id: users_id }, function (response) {
                if (response.includes('success')) {
                    row.remove();
                    $("#custom-alert").hide();
                    $("#custom-alert .message").text('Đã gửi yêu cầu phê duyệt thành công!');
                    $(".btn-close").show();
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

    function loadFilterBox() {
        $.post("getFilterBoxForBirthYear.php", {}, function (response) {
            $('#birthYearCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForFirstName.php", {}, function (response) {
            $('#firstNameCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForLastName.php", {}, function (response) {
            $('#lastNameCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForSchool.php", {}, function (response) {
            $('#SchoolCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
        $.post("getFilterBoxForSubDate.php", {}, function (response) {
            $('#SubDateCheckboxes').append(response);
        }).fail(function () {
            alert("Không thể tải dữ liệu.");
            return;
        });
    }

    function displayUserData() {
        $.post("getData.php", {}, function (response) {
            $('#user-table').append(response);
            $('#user-table tr').each(function () {
                originalRows.push($(this).clone());
            });
        }).fail(function () {
            alert("Có lỗi xảy ra, vui lòng thử lại.");
        });
    }
    function convertToDate(dateString) {
        var parts = dateString.split(' ');
        var timeParts = parts[0].split(':');
        var dateParts = parts[1].split('/');

        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);
        var seconds = parseInt(timeParts[2], 10);
        var day = parseInt(dateParts[0], 10);
        var month = parseInt(dateParts[1], 10) - 1;
        var year = parseInt(dateParts[2], 10);

        return new Date(year, month, day, hours, minutes, seconds);
    }
});
