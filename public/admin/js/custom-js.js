// Sweet Alert Ban
function BanAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Status
function StatusAction(event, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.getAttribute('href');
        }
    });

    return false;
}
// Sweet Alert Delete
function deleteAction(userId, message, btnClass) {
    Swal.fire({
        title: 'Confirmation',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Trigger the form submission
            document.getElementById('deleteForm' + userId).submit();
        }
    });

    return false;
}


// permissions using input #id
// $(document).ready(function () {
//
//     function updateAllCheckbox(allCheckboxId, individualCheckboxPrefix) {
//         var allChecked = true;
//         $('input[id^="' + individualCheckboxPrefix + '"]').each(function () {
//             if (!$(this).prop('checked')) {
//                 allChecked = false;
//                 return false;
//             }
//         });
//         $('#' + allCheckboxId).prop('checked', allChecked);
//     }
//
//     function handleAllCheckboxClick(allCheckboxId, individualCheckboxPrefix) {
//         $('#' + allCheckboxId).click(function () {
//             var isChecked = $(this).prop('checked');
//             $('input[id^="' + individualCheckboxPrefix + '"]').prop('checked', isChecked);
//             updateAllCheckbox(allCheckboxId, individualCheckboxPrefix);
//
//             if (individualCheckboxPrefix === 'department_') {
//                 updateDepartmentCheckbox();
//             }
//             if (individualCheckboxPrefix === 'designation_') {
//                 updateDesignationCheckbox();
//             }
//             if (individualCheckboxPrefix === 'employ_') {
//                 updateEmployCheckbox();
//             }
//             if (individualCheckboxPrefix === 'profile_') {
//                 updateUserCheckbox();
//             }
//
//             updateServerCheckbox(allCheckboxId, isChecked);
//         });
//     }
//
//     function updateDepartmentCheckbox() {
//         var departmentManage = $('#department_manage').prop('checked');
//         var departmentCreate = $('#department_create').prop('checked');
//         var departmentView   = $('#department_detail').prop('checked');
//         var departmentNumber = $('#department_number').prop('checked');
//         var departmentEdit   = $('#department_edit').prop('checked');
//         var departmentStatus = $('#department_status').prop('checked');
//         var departmentDelete = $('#department_delete').prop('checked');
//
//         if (departmentManage && departmentCreate && departmentNumber && departmentStatus && departmentView && departmentEdit && departmentDelete) {
//             $('#user_department').prop('checked', true);
//         } else {
//             $('#user_department').prop('checked', false);
//         }
//     }
//
//     function updateDesignationCheckbox() {
//         var designationManage = $('#designation_manage').prop('checked');
//         var designationNumber = $('#designation_number').prop('checked');
//         var designationCreate = $('#designation_create').prop('checked');
//         var designationDetail = $('#designation_detail').prop('checked');
//         var designationEdit = $('#designation_edit').prop('checked');
//         var designationStatus = $('#designation_status').prop('checked');
//         var designationDelete = $('#designation_delete').prop('checked');
//
//         if (designationManage && designationNumber && designationCreate && designationDetail && designationEdit && designationStatus && designationDelete) {
//             $('#user_designation').prop('checked', true);
//         } else {
//             $('#user_designation').prop('checked', false);
//         }
//     }
//
//     function updateEmployCheckbox() {
//         var employManageChecked = $('#employ_manage').prop('checked');
//         var employDetailChecked = $('#employ_detail').prop('checked');
//         var employCreateChecked = $('#employ_create').prop('checked');
//         var employEditChecked = $('#employ_edit').prop('checked');
//         var employPermissionChecked = $('#employ_permission').prop('checked');
//         var employPasswordChecked = $('#employ_password').prop('checked');
//         var employRestrictionChecked = $('#employ_restriction').prop('checked');
//         var employDeleteChecked = $('#employ_delete').prop('checked');
//
//         if (employManageChecked && employDetailChecked &&  employCreateChecked && employEditChecked && employPermissionChecked && employPasswordChecked && employRestrictionChecked && employDeleteChecked) {
//             $('#employ_all').prop('checked', true);
//         } else {
//             $('#employ_all').prop('checked', false);
//         }
//     }
//
//     function updateUserCheckbox() {
//         var profileSettingChecked = $('#profile_setting').prop('checked');
//         var profileEditChecked = $('#profile_edit').prop('checked');
//         var profileEmailChecked = $('#profile_email').prop('checked');
//         var profilePhoneChecked = $('#profile_phone').prop('checked');
//         var profileNumberChecked = $('#profile_number').prop('checked');
//         var profileRoleChecked = $('#profile_role').prop('checked');
//         var profileDepartmentDesignationChecked = $('#profile_department_designation').prop('checked');
//
//
//         if (profileSettingChecked && profileEditChecked &&  profileEmailChecked && profilePhoneChecked && profileNumberChecked && profileRoleChecked && profileDepartmentDesignationChecked) {
//             $('#user_profile').prop('checked', true);
//         } else {
//             $('#user_profile').prop('checked', false);
//         }
//     }
//
//     function handleUserProfileCheckboxClick() {
//         $('#user_profile').click(function () {
//             var isChecked = $(this).prop('checked');
//             $('input[id^="profile_"]').prop('checked', isChecked);
//             updateUserCheckbox();
//             updateAllCheckbox('user_profile', 'profile_');
//             updateServerCheckbox('user_profile', isChecked);
//         });
//     }
//
//     function updateServerCheckbox(checkboxId, isChecked) {
//         $.ajax({
//             url: 'your-server-script.php',
//             method: 'POST',
//             data: {
//                 checkboxId: checkboxId,
//                 isChecked: isChecked
//             },
//             success: function (response) {
//                 console.log(response);
//             },
//             error: function (xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     }
//
//     handleAllCheckboxClick('users_all', 'user_');
//     handleAllCheckboxClick('users_all', 'department_');
//     handleAllCheckboxClick('users_all', 'designation_');
//     handleAllCheckboxClick('users_all', 'employ_');
//
//     handleAllCheckboxClick('user_department', 'department_');
//     handleAllCheckboxClick('user_designation', 'designation_');
//     handleAllCheckboxClick('employ_all', 'employ_');
//
//     handleAllCheckboxClick('user_profile', 'profile_');
//
//     $('input[id="department_create"], input[id="department_detail"], input[id="department_number"], input[id="department_manage"], input[id="department_status"], input[id="department_edit"], input[id="department_delete"]').click(function () {
//         updateAllCheckbox('users_all', 'department_');
//         updateAllCheckbox('users_all', 'designation_');
//         updateAllCheckbox('users_all', 'employ_');
//         updateDepartmentCheckbox();
//         updateDesignationCheckbox();
//         updateEmployCheckbox();
//         updateServerCheckbox('users_all', $('#users_all').prop('checked'));
//     });
//
//     $('input[id^="user_"], input[id^="department_"], input[id^="designation_"], input[id^="employ_"]').click(function () {
//         updateAllCheckbox('users_all', 'user_');
//         updateAllCheckbox('users_all', 'department_');
//         updateAllCheckbox('users_all', 'designation_');
//         updateAllCheckbox('users_all', 'employ_');
//
//         var departmentCheckboxes = $('input[id^="department_"]');
//         if (departmentCheckboxes.length === departmentCheckboxes.filter(':checked').length) {
//             $('#user_department').prop('checked', true);
//         } else {
//             $('#user_department').prop('checked', false);
//         }
//
//         var designationCheckboxes = $('input[id^="designation_"]');
//         if (designationCheckboxes.length === designationCheckboxes.filter(':checked').length) {
//             $('#user_designation').prop('checked', true);
//         } else {
//             $('#user_designation').prop('checked', false);
//         }
//
//         var employCheckboxes = $('input[id^="employ_"]');
//         if (employCheckboxes.length === employCheckboxes.filter(':checked').length) {
//             $('#employ_all').prop('checked', true);
//         } else {
//             $('#employ_all').prop('checked', false);
//         }
//
//         if ($('#user_department').prop('checked') && $('#user_designation').prop('checked') && $('#employ_all').prop('checked')) {
//             $('#users_all').prop('checked', true);
//         } else {
//             $('#users_all').prop('checked', false);
//         }
//
//         updateServerCheckbox('users_all', $('#users_all').prop('checked'));
//     });
//
//     $('input[id="profile_setting"], input[id="profile_edit"], input[id="profile_email"], input[id="profile_phone"], input[id="profile_number"], input[id="profile_role"], input[id="profile_department_designation"]').click(function () {
//         handleUserProfileCheckboxClick();
//     });
//
//     $('input[id^="profile_"]').click(function () {
//         // handleUserProfileCheckboxClick();
//         updateAllCheckbox('user_profile', 'profile_');
//
//         var profileCheckboxes = $('input[id^="profile_"]');
//         if (profileCheckboxes.length === profileCheckboxes.filter(':checked').length) {
//             $('#user_profile').prop('checked', true);
//         } else {
//             $('#user_profile').prop('checked', false);
//         }
//     });
//
// });


// jquery select checksm
$(function(){
    $('form').checkem();
});


//User Departments & Designations Dropdown
$(document).ready(function() {
    $('#department').change(function() {
        var departmentId = $(this).val();
        $.ajax({
            url: '/getDesignationsByDepartment',
            type: 'GET',
            dataType: 'json',
            data: {
                department_id: departmentId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#designation').html(options);
            }
        });
    });

});

// Career Departments & Career Designations Dropdown & prefix_id/job_id
$(document).ready(function() {
    $('#career_department').change(function() {
        var careerDepartmentId = $(this).val();
        $.ajax({
            url: '/getCareerDesignationsByDepartment',
            type: 'GET',
            dataType: 'json',
            data: {
                career_department_id: careerDepartmentId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#career_designation').html(options);

                // Trigger the change event to update prefix_id when a new designation is loaded
                $('#career_designation').trigger('change');
            }
        });
    });

    $('#career_designation').change(function() {
        var careerDesignationId = $(this).val();
        $.ajax({
            url: '/getPrefixIdByDesignation',
            type: 'GET',
            dataType: 'json',
            data: {
                career_designation_id: careerDesignationId
            },
            success: function(response) {
                $('#prefix_id').val(response.prefix_id); // Set the value directly
            }
        });
    });

    // Initial load to set prefix_id based on the initial selected career_designation
    var initialCareerDesignationId = $('#career_designation').val();
    if (initialCareerDesignationId) {
        $('#career_designation').trigger('change');
    }
});


//Event Category & Events Dropdown
$(document).ready(function() {
    $('#eventCategory').change(function() {
        var eventCategoryId = $(this).val();
        $.ajax({
            url: '/getEventsByEventCategory',
            type: 'GET',
            dataType: 'json',
            data: {
                event_category_id: eventCategoryId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].title + '</option>';
                }
                $('#event').html(options);
            }
        });
    });

});


//Company & Apps Dropdown
$(document).ready(function() {
    $('#company_id').change(function() {
        var companyId = $(this).val();
        $.ajax({
            url: '/getAppsByCompany',
            type: 'GET',
            dataType: 'json',
            data: {
                company_id: companyId
            },
            success: function(response) {
                var options = '';
                for (var i = 0; i < response.length; i++) {
                    options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                }
                $('#app_id').html(options);
            }
        });
    });

});

// Password Show
$(document).ready(function() {
    $('#togglePassword').click(function() {
        var x = document.getElementById("current_password");

        if (x.type === "password") {
            x.type = "text";
            $('#togglePassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#togglePassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleNewPassword').click(function() {
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleNewPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleNewPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    $('#toggleConfirmPassword').click(function() {
        var x = document.getElementById("password_confirmation");

        if (x.type === "password") {
            x.type = "text";
            $('#toggleConfirmPassword').removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $('#toggleConfirmPassword').removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });
});

// password validation
$(document).ready(function () {
    // Function to validate the password format
    function validatePasswordFormat(password) {
        var lowercaseRegex = /^(?=.*[a-z])/;
        var uppercaseRegex = /^(?=.*[A-Z])/;
        var digitRegex = /^(?=.*\d)/;
        var specialCharRegex = /^(?=.*[@$!%*?&])/;
        var lengthRegex = /^.{8,25}$/;

        return {
            lowercase: lowercaseRegex.test(password),
            uppercase: uppercaseRegex.test(password),
            digit: digitRegex.test(password),
            specialChar: specialCharRegex.test(password),
            length: lengthRegex.test(password),
        };
    }

    // Function to update the password validation messages
    function updatePasswordValidationMessages(validationResults) {
        $('#lowercase-message').text(validationResults.lowercase ? '' : 'Password must contain at least one lowercase letter.');
        $('#uppercase-message').text(validationResults.uppercase ? '' : 'Password must contain at least one uppercase letter.');
        $('#digit-message').text(validationResults.digit ? '' : 'Password must contain at least one digit.');
        $('#special-char-message').text(validationResults.specialChar ? '' : 'Password must contain at least one special character.');
        $('#length-message').text(validationResults.length ? '' : 'Password must be between 8 and 25 characters.');
    }

    // Function to check if all validations are true
    function areAllValidationsTrue(validationResults) {
        return validationResults.lowercase &&
            validationResults.uppercase &&
            validationResults.digit &&
            validationResults.specialChar &&
            validationResults.length;
    }

    // Event handler for password input
    $('#password').on('input', function () {
        var password = $(this).val();
        var validationResults = validatePasswordFormat(password);
        updatePasswordValidationMessages(validationResults);

        // Enable or disable the submit button based on validation results
        var isSubmitButtonDisabled = !areAllValidationsTrue(validationResults);
        $('#submit-button').prop('disabled', isSubmitButtonDisabled);
    });

});

// confirm password validation
$(document).ready(function () {

    // Function to update the password match message
    function updatePasswordMatchMessage(isMatch) {
        if (isMatch) {
            $('#match-message').removeClass('text-danger').addClass('text-success').text('Passwords match.');
        } else {
            $('#match-message').removeClass('text-success').addClass('text-danger').text('Passwords do not match.');
        }
    }

    // Function to check if the input fields are not empty
    function isNotEmpty(value) {
        return value.trim() !== '';
    }

    // Event handler for password confirmation input
    $('#password_confirmation').on('input', function () {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Event handler for password input
    $('#password').on('input', function () {
        var password = $(this).val();
        var validationResults = validatePasswordFormat(password);
        updatePasswordValidationMessages(validationResults);

        // Also check for password match when the password changes
        var confirmPassword = $('#password_confirmation').val();
        var isNotEmptyFields = isNotEmpty(password) && isNotEmpty(confirmPassword);
        var isMatch = isNotEmptyFields && validatePasswordMatch(password, confirmPassword);
        updatePasswordMatchMessage(isMatch);
    });

    // Initialize the match message only if both fields are not empty
    var initialPassword = $('#password').val();
    var initialConfirmPassword = $('#password_confirmation').val();
    if (isNotEmpty(initialPassword) && isNotEmpty(initialConfirmPassword)) {
        updatePasswordMatchMessage(initialPassword === initialConfirmPassword);
    }

});

// Function to validate password match
function validatePasswordMatch(password, confirmPassword) {
    return password === confirmPassword;
}

// Summernote one to many
$(document).ready(function() {
    $('#note1').summernote({
        height: 200
    });
    $('#note2').summernote({
        height: 150
    });

});


// Summernote Imgae modal popup fade problem
$(document).mouseup(function (e) {
    var container = $(".note-modal");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.modal('hide');
    }
});

$(document).keyup(function (e) {
    if (e.key === "Escape") {
        $(".note-modal").modal('hide');
    }
});


// blog next page
$(document).ready(function () {
    // Add an event listener to the English tab
    $('#englishTab').click(function () {
        // Show form-one and hide form-two
        $('#form-one').show();
        $('#form-two').hide();

        // Show the Next button and hide the Submit button
        $('#next-one').show();
        $('#previous-button-one').hide();
        $('#submit-one').hide();
    });

    $('#next-button-english').click(function () {
        // Show form-one and hide form-two
        $('#form-one').hide();
        $('#form-two').show();

        // Show the Next button and hide the Submit button
        $('#previous-button-one').show();
        $('#next-one').hide();
        $('#submit-one').show();
    });

    $('#previous-button-one').click(function () {
        // Show form-one and hide form-two
        $('#form-one').show();
        $('#form-two').hide();

        // Show the Next button and hide the Submit button
        $('#previous-button-one').hide();
        $('#next-one').show();
        $('#submit-one').hide();
    });

    // Add an event listener to the Bangla tab
    $('#banglaTab').click(function () {
        // Show form-one and hide form-two
        $('#form-three').show();
        $('#form-four').hide();

        // Show the Next button and hide the Submit button
        $('#previous-button-two').hide();
        $('#next-two').show();
        $('#submit-two').hide();
    });

    $('#next-button-bangla').click(function () {
        // Show form-one and hide form-two
        $('#form-three').hide();
        $('#form-four').show();

        // Show the Next button and hide the Submit button
        $('#previous-button-two').show();
        $('#next-two').hide();
        $('#submit-two').show();
    });

    $('#previous-button-two').click(function () {
        // Show form-one and hide form-two
        $('#form-three').show();
        $('#form-four').hide();

        // Show the Next button and hide the Submit button
        $('#previous-button-two').hide();
        $('#next-two').show();
        $('#submit-two').hide();
    });
});

// Blog validation

$(document).ready(function() {

    // English Title
    $("#title").keyup(function() {
        var title = $("#title").val();
        var charCountTitle = title.length;
        $("#char-count-title").text(charCountTitle);
        var remainingChars = 60 - charCountTitle;

        $("#char-count-title").text(remainingChars);

        if (remainingChars >= 0 && remainingChars <= 60) {
            $("#char-count-title").css("color", "gray");
        } else if (remainingChars >= -40 && remainingChars < 0) {
            $("#char-count-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-title").text("");
        $("#title").removeClass("box_error");

        if (title.length < 50 || title.length > 60 || isNaN(title)) {
            $("#error-title").text("Title length must be between 50 and 60 Characters.").css("color", "red");
            $("#title").addClass("box_error");
        }
        if ((title.length >= 50) && (title.length <= 60)) {
            $("#error-title").text("Title is good now.").css("color", "green");
            $("#title").addClass("box_error");
            error = true;
        }

    });

    // English Short Description
    $("#short_description").keyup(function() {
        var shortDescription = $("#short_description").val();
        var charCountShortDescription = shortDescription.length;
        $("#char-count-short-description").text(charCountShortDescription);
        var remainingCharCountShortDescription = 220 - charCountShortDescription;

        $("#char-count-short-description").text(remainingCharCountShortDescription);

        if (remainingCharCountShortDescription >= 0 && remainingCharCountShortDescription <= 220) {
            $("#char-count-short-description").css("color", "gray");
        } else if (remainingCharCountShortDescription >= -30 && remainingCharCountShortDescription < 0) {
            $("#char-count-short-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-short-description").text("");
        $("#short_description").removeClass("box_error");

        if (shortDescription.length < 100 || shortDescription.length > 220 || isNaN(shortDescription)) {
            $("#error-short-description").text("Short description length must be between 100 and 220 Characters.").css("color", "red");
            $("#short_description").addClass("box_error");
        }
        if ((shortDescription.length >= 100) && (shortDescription.length <= 220)) {
            $("#error-short-description").text("Short description is good now.").css("color", "green");
            $("#short_description").addClass("box_error");
            error = true;
        }

    });

    // English Meta Title
    $("#meta_title").keyup(function() {
        var metaTitle = $("#meta_title").val();
        var charCountMetaTitle = metaTitle.length;
        $("#char-count-meta-title").text(charCountMetaTitle);
        var remainingCharCountMetaTitle = 60 - charCountMetaTitle;

        $("#char-count-meta-title").text(remainingCharCountMetaTitle);

        if (remainingCharCountMetaTitle >= 0 && remainingCharCountMetaTitle <= 60) {
            $("#char-count-meta-title").css("color", "gray");
        } else if (remainingCharCountMetaTitle >= -40 && remainingCharCountMetaTitle < 0) {
            $("#char-count-meta-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-meta-title").text("");
        $("#meta_title").removeClass("box_error");

        if (metaTitle.length < 50 || metaTitle.length > 60 || isNaN(metaTitle)) {
            $("#error-meta-title").text("Meta title length must be between 50 and 60 Characters.").css("color", "red");
            $("#meta_title").addClass("box_error");
        }
        if ((metaTitle.length >= 50) && (metaTitle.length <= 60)) {
            $("#error-meta-title").text("Meta title is good now.").css("color", "green");
            $("#meta_title").addClass("box_error");
            error = true;
        }

    });

    // English Meta Description
    $("#meta_description").keyup(function() {
        var metaDescription = $("#meta_description").val();
        var charCountMetaDescription = metaDescription.length;
        $("#char-count-meta-description").text(charCountMetaDescription);
        var remainingCharCountMetaDescription = 160 - charCountMetaDescription;

        $("#char-count-meta-description").text(remainingCharCountMetaDescription);

        if (remainingCharCountMetaDescription >= 0 && remainingCharCountMetaDescription <= 160) {
            $("#char-count-meta-description").css("color", "gray");
        } else if (remainingCharCountMetaDescription >= -40 && remainingCharCountMetaDescription < 0) {
            $("#char-count-meta-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-meta-description").text("");
        $("#meta_description").removeClass("box_error");

        if (metaDescription.length < 150 || metaDescription.length > 160 || isNaN(metaDescription)) {
            $("#error-meta-description").text("Meta description length must be between 150 and 160 Characters.").css("color", "red");
            $("#meta_description").addClass("box_error");
        }
        if ((metaDescription.length >= 150) && (metaDescription.length <= 160)) {
            $("#error-meta-description").text("Meta description is good now.").css("color", "green");
            $("#meta_description").addClass("box_error");
            error = true;
        }

    });

    // Bangla Title
    $("#bangla-title").keyup(function() {
        var banglaTitle = $("#bangla-title").val();
        var charCountBanglaTitle = banglaTitle.length;
        $("#char-count-bangla-title").text(charCountBanglaTitle);
        var remainingCharCountBanglaTitle = 60 - charCountBanglaTitle;

        $("#char-count-bangla-title").text(remainingCharCountBanglaTitle);

        if (remainingCharCountBanglaTitle >= 0 && remainingCharCountBanglaTitle <= 60) {
            $("#char-count-bangla-title").css("color", "gray");
        } else if (remainingCharCountBanglaTitle >= -40 && remainingCharCountBanglaTitle < 0) {
            $("#char-count-bangla-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-title").text("");
        $("#bangla-title").removeClass("box_error");

        if (banglaTitle.length < 50 || banglaTitle.length > 60 || isNaN(banglaTitle)) {
            $("#error-bangla-title").text("শিরোনামের দৈর্ঘ্য ৫০ থেকে ৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla-title").addClass("box_error");
        }
        if ((banglaTitle.length >= 50) && (banglaTitle.length <= 60)) {
            $("#error-bangla-title").text("শিরোনাম এখন ভালো।").css("color", "green");
            $("#bangla-title").addClass("box_error");
            error = true;
        }

    });

    // Bangla Short Description
    $("#bangla_short_description").keyup(function() {
        var banglaShortDescription = $("#bangla_short_description").val();
        var charCountBanglaShortDescription = banglaShortDescription.length;
        $("#char-count-bangla-short-description").text(charCountBanglaShortDescription);
        var remainingCharCountBanglaShortDescription = 220 - charCountBanglaShortDescription;

        $("#char-count-bangla-short-description").text(remainingCharCountBanglaShortDescription);

        if (remainingCharCountBanglaShortDescription >= 0 && remainingCharCountBanglaShortDescription <= 220) {
            $("#char-count-bangla-short-description").css("color", "gray");
        } else if (remainingCharCountBanglaShortDescription >= -30 && remainingCharCountBanglaShortDescription < 0) {
            $("#char-count-bangla-short-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-short-description").text("");
        $("#bangla_short_description").removeClass("box_error");

        if (banglaShortDescription.length < 100 || banglaShortDescription.length > 220 || isNaN(banglaShortDescription)) {
            $("#error-bangla-short-description").text("সংক্ষিপ্ত বিবরণের দৈর্ঘ্য ১০০ থেকে ২২০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla_short_description").addClass("box_error");
        }
        if ((banglaShortDescription.length >= 100) && (banglaShortDescription.length <= 220)) {
            $("#error-bangla-short-description").text("সংক্ষিপ্ত বিবরণ এখন ভাল.").css("color", "green");
            $("#bangla_short_description").addClass("box_error");
            error = true;
        }

    });

    // Bangla Meta Title
    $("#bangla-meta-title").keyup(function() {
        var banglaMetaTitle = $("#bangla-meta-title").val();
        var charCountBanglaMetaTitle = banglaMetaTitle.length;
        $("#char-count-bangla-meta-title").text(charCountBanglaMetaTitle);
        var remainingCharCountBanglaMetaTitle = 60 - charCountBanglaMetaTitle;

        $("#char-count-bangla-meta-title").text(remainingCharCountBanglaMetaTitle);

        if (remainingCharCountBanglaMetaTitle >= 0 && remainingCharCountBanglaMetaTitle <= 60) {
            $("#char-count-bangla-meta-title").css("color", "gray");
        } else if (remainingCharCountBanglaMetaTitle >= -40 && remainingCharCountBanglaMetaTitle < 0) {
            $("#char-count-bangla-meta-title").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-meta-title").text("");
        $("#bangla-meta-title").removeClass("box_error");

        if (banglaMetaTitle.length < 50 || banglaMetaTitle.length > 60 || isNaN(banglaMetaTitle)) {
            $("#error-bangla-meta-title").text("মেটা শিরোনামের দৈর্ঘ্য ৫০ থেকে ৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla-meta-title").addClass("box_error");
        }
        if ((banglaMetaTitle.length >= 50) && (banglaMetaTitle.length <= 60)) {
            $("#error-bangla-meta-title").text("মেটা শিরোনাম এখন ভালো।").css("color", "green");
            $("#bangla-meta-title").addClass("box_error");
            error = true;
        }

    });

    // Bangla Meta Description
    $("#bangla_meta_description").keyup(function() {
        var banglaMetaDescription = $("#bangla_meta_description").val();
        var charCountBanglaMetaDescription = banglaMetaDescription.length;
        $("#char-count-bangla-meta-description").text(charCountBanglaMetaDescription);
        var remainingCharCountBanglaMetaDescription = 160 - charCountBanglaMetaDescription;

        $("#char-count-bangla-meta-description").text(remainingCharCountBanglaMetaDescription);

        if (remainingCharCountBanglaMetaDescription >= 0 && remainingCharCountBanglaMetaDescription <= 160) {
            $("#char-count-bangla-meta-description").css("color", "gray");
        } else if (remainingCharCountBanglaMetaDescription >= -40 && remainingCharCountBanglaMetaDescription < 0) {
            $("#char-count-bangla-meta-description").css("color", "red");
        }

        var error = false;
        // Clear previous error and box_error class
        $("#error-bangla-meta-description").text("");
        $("#bangla_meta_description").removeClass("box_error");

        if (banglaMetaDescription.length < 150 || banglaMetaDescription.length > 160 || isNaN(banglaMetaDescription)) {
            $("#error-bangla-meta-description").text("মেটা বিবরণের দৈর্ঘ্য ১৫০ থেকে ১৬০ অক্ষরের মধ্যে সীমাবদ্ধ।").css("color", "red");
            $("#bangla_meta_description").addClass("box_error");
        }
        if ((banglaMetaDescription.length >= 150) && (banglaMetaDescription.length <= 160)) {
            $("#error-bangla-meta-description").text("মেটা বিবরণ এখন ভাল.").css("color", "green");
            $("#bangla_meta_description").addClass("box_error");
            error = true;
        }

    });

});

