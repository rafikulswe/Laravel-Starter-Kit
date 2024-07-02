/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

//  ### image preview before upload
function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $("#previewImg").attr("src", reader.result);
        };

        reader.readAsDataURL(file);
    }
}
// ----------------------------------------------------------------------------------- end

//  ### globaly delete data with sweet alert message
$(document).on("click", ".data-list .delete", function (e) {
    e.preventDefault();
    var deleteLinkUrl = $(this).attr("delete-link");
    var dataType = $(this).attr("data-type") ?
        $(this).attr("data-type") :
        "html";
    var csrf = $(this).find("input[name='_token']").val();

    swalInit.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",

        preConfirm: function () {
            $.ajax({
                url: deleteLinkUrl,
                type: "POST",
                data: {
                    _token: csrf,
                    _method: "DELETE"
                },
                dataType: dataType,
                success: function (data) {
                    console.log(data);
                    var dataError =
                        dataType == "html" ? data.trim() : data.error;
                    if (typeof dataError !== typeof undefined && dataError) {
                        swalInit.fire({
                            title: "Oops...",
                            text: dataError,
                            icon: "error",
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        });
                    } else {
                        swalInit.fire({
                            title: "Deleted!",
                            text: "This data has been deleted!",
                            confirmButtonColor: "#66BB6A",
                            icon: "success",
                            type: "success",
                            preConfirm: function () {
                                location.reload();
                            },
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swalInit.fire({
                        title: "Oops...",
                        text: dataError,
                        icon: "error",
                        allowEscapeKey: false,
                        allowEnterKey: false,
                    });
                },
            });
        },
    });
});
// Defaults sweet alert js
var swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-light",
        denyButton: "btn btn-light",
        input: "form-control",
    },
});
// ----------------------------------------------------------------------------------- end

// submit button disable when i click Submit
(function () {
    $('.from-prevent-multiple-submits').on('submit', function () {
        $('.form-submit-btn').attr('disabled', 'true');
    })
})();
// ----------------------------------------------------------------------------------- end


// START SERVER SITE DATA LOADING
// FRAME START
var urlSeparatorDataTable = "~";

function loadDataTable(selector) {
    let loadUrl = (selector.find('.panel-laod').attr('load-url')) ? selector.find('.panel-laod').attr('load-url') : false;
    let inputArray = {};

    if (loadUrl) {
        let that = selector;
        selector.find(".data-list")
            //Pagination
            .on('click', ".pagination li a", function (e) {
                e.preventDefault();
                var paginateUrl = $(this).attr("href");
                var paginateUrl = paginateUrl.split("page=");
                var page = (paginateUrl.length == 2) ? paginateUrl[1] : "";
                inputArray["page"] = page;
                loadAjaxContentData(that, loadUrl, inputArray);
            }) //PerPage
            .on('change', "#perPage", function (e) {
                e.preventDefault();
                var perPage = $(this).val();
                inputArray["perPage"] = perPage;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
            }) //AscDesc
            .on('click', ".data-sorting", function (e) {
                e.preventDefault();

            }) //select filtering
            .on('change', ".data-search", function (e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).val();
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            }) //search Data
            .on('enter', ".data-search", function (e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).val();
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            })
            .on('click', ".table_filter_button button", function (e) {
                //Data Search
                let searchName = $(this).attr("name");
                let searchValue = $(this).attr('sortId');
                inputArray[searchName] = searchValue;
                inputArray["page"] = "";
                loadAjaxContentData(that, loadUrl, inputArray);
                e.preventDefault();
            })


        loadAjaxContentData(that, loadUrl, inputArray);
    } else {
        swalInit.fire({
            title: "Opps!!",
            text: "Set Load URL",
            icon: "warning",
            showCancelButton: true,
        });
    }
}

function loadAjaxContentData(that, loadUrl, inputArray) {

    preLoader(that);
    $.ajax({
        mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
        url: loadUrl,
        data: inputArray,
        type: 'GET',
        dataType: "html",
        success: function (response) {
            if (parseInt(response) === 0) {
                redirectLoginPage('provider');
            } else {
                preLoaderHide(that);
                that.find(".data-list").html(response);
            }
        }
    });
}

function preLoader(that) {
    // app.js find (Reload card (uses BlockUI extension))
    // that.find('.data-list').append($(`<div class="card-overlay"><i class="icon-spinner9 spinner text-body"></i></div>`));

    that.find('.data-list').html(`<div class="card-overlay">
        <i class="icon-spinner9 spinner text-body"></i>
    </div>`);
}

function preLoaderHide(that) {
    that.find('.card-overlay').remove();
}

function redirectLoginPage(userType) {
    swalInit.fire({
        title: "Sorry!!",
        text: "You have logged out.",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: "Login Now!",

        preConfirm: function () {
            if (userType === 'provider') {
                location.replace('login');
            }
        }
    });
}
// END SERVER SITE DATA LOADING

// DECISION MAKE SWALL ACTION
$(document).on('click', '.data-list #updateStatus', function (e) {
    e.preventDefault();
    let selector = $(this);
    var decisionLinkUrl = selector.attr('decision-link');
    var alertText = selector.attr('alert-text');
    var confirmBtnText = selector.attr('confirmBtn-text');
    var csrf = selector.find("input[name='_token']").val();
    let isChecked = selector.find('.update-checkbox').attr('checked') ? selector.find('.update-checkbox').attr('checked') : false;

    swalInit.fire({
        title: "Are you sure?",
        text: alertText,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7043",
        confirmButtonText: confirmBtnText,
        willClose: false,

        preConfirm: function () {
            $.ajax({
                url: decisionLinkUrl,
                type: "POST",
                data: {
                    "_token": csrf,
                    '_method': 'POST'
                },
                dataType: 'json',
                success: function (response) {
                    let msgType = response.msgType;
                    let messege = response.messege;
                    if (msgType == 'danger') {
                        swalInit.fire({
                            title: "Opps!!",
                            text: messege,
                            confirmButtonColor: "#EF5350",
                            icon: "error"
                        });
                    } else {
                        swalInit.fire({
                            title: "Done!",
                            text: messege,
                            confirmButtonColor: "#66BB6A",
                            icon: 'success',

                            preConfirm: function () {
                                // location.reload();
                                selector.find('.update-checkbox').attr('checked', !isChecked);
                            }
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swalInit.fire({
                        title: "Opps!!",
                        text: "Seems you couldn't submit form for a longtime. Please refresh your form & try again",
                        confirmButtonColor: "#EF5350",
                        icon: "error"
                    });
                }
            });
        }
    });

})


// bootBox modal start
$(document).on('click', '.data-list .open-modal', function (e) {

    e.preventDefault();
    var modalTitle = $(this).attr('modal-title');
    var modalType = $(this).attr('modal-type');
    var modalSize = $(this).attr('modal-size');
    var className = $(this).attr('modal-class');
    var url = $(this).attr('modal-link');
    var selector = $(this).attr('selector');

    if (modalType == "create") {
        var successButton = "Save";
    } else if (modalType == "update") {
        var successButton = "Update";
    }

    $.ajax({
        url: url,
        type: 'GET',
        dataType: "html",
        success: function (response) {
            if (modalType != "show") {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-light"
                        },
                        success: {
                            label: successButton,
                            className: "btn-success disable-on-click",
                            "callback": function () {
                                $("#" + selector + " form").submit();
                                return false;
                            }
                        }
                    }
                });
            } else {
                bootbox.dialog({
                    message: '<div id="' + selector + '">Loading . . .</div>',
                    size: modalSize,
                    title: modalTitle,
                    className: className,
                    buttons: {
                        close: {
                            label: "Close",
                            className: "btn-light"
                        }
                    }
                });
            }
            $("#" + selector).html(response);
            $("#submit_btn").removeAttr("disabled", "disabled");
        }
    });

})
// bootBox modal end
